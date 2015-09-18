/*
* 
*   Game.js
* 
*   Created by Dries Van Schevensteen on 12/03/15.
*
*/

var Game = function() {

    console.log('Game');

    // To check if game is already loaded at replay
    var isInitialStart = true;

    // Player object that stores score, name and country
    var player = new Player();

    // Game over event
    var event = new Event('gameOver');

    // Load bar and CreateJS canvas
    var loader, stage;

    // Character object and the character sprite customized by players selection
    var character, characterSprite;

    // Parallax background object and background image names
    var prllxBackground, prllxBackgroundImages = {};

    // Ground object and ground image names
    var ground, groundImages = {};

    // Obstacles character has to avoid
    var obstacles = [];

    // Basket and ball user has to throw in basket
    var basket, ball;

    // HUD that displays score and powerbar that shows power to shoot at basket
    var hud, powerBar;

    // Speed at which ground, background, basket and obstacles move
    var speed = 5;

    // Starts game by loading assets or restarts if already played
    this.startGame = function() {
        
        console.log('startGame');

        if (isInitialStart) {
            event.initEvent('gameOver', true, true);
            preload();
        } else
            restart();

        isInitialStart = false;
    };

    // Preload and store assets in local vars
    function preload() {
        
        console.log('preload');

        loader = new createjs.LoadQueue(true);

        loader.installPlugin(createjs.Sound);
        loader.on('complete', _onComplete);

        loader.loadManifest([
            { id: 'box1', src: 'images/box-1.png' },
            { id: 'box2', src: 'images/box-2.png' },
            { id: 'ground', src: 'images/Tile-Ground.png' },
            { id: 'air', src: 'images/Tile-Air.png' },
            { id: 'ravine', src: 'images/Tile-Ravine.png' },
            { id: 'character', src: 'images/character.png' },
            { id: 'bgFront1', src: 'images/Tile-Front-1.png' },
            { id: 'bgMiddle1', src: 'images/Tile-Middle-1.png' },
            { id: 'bgBack1', src: 'images/Tile-Back-1.png' }
        ]);

        // Nested function called after all assets are loaded and assigns assets to variables
        function _onComplete() {

            console.log('onComplete');

            groundImages = {
                    boxes: [loader.getResult('box1'), loader.getResult('box2')],
                    ground: loader.getResult('ground'), 
                    air: loader.getResult('air'), 
                    ravine:loader.getResult('ravine')
                };

            prllxBackgroundImages = {
                    front: [loader.getResult('bgFront1')],
                    middle: [loader.getResult('bgMiddle1')],
                    back: [loader.getResult('bgBack1')]
                };

            characterSprite = loader.getResult('character');

            _init();

            // Nested function that initialises stage with ticker and interaction events
            function _init() {

                console.log('init');

                var canvas = document.getElementById('gameCanvas');

                stage = new createjs.Stage(canvas);

                createjs.Ticker.setFPS(30);
                _ticklistener = createjs.Ticker.addEventListener('tick', onTick);

                stage.on('stagemousemove', stageMouseMove);
                stage.on('stagemouseup', stageMouseUp);

                _createScene();

                // Nested function that adds all elements to the scene
                function _createScene() {

                    console.log('createScene');

                    prllxBackground = new PrllxBackground(getStageDimesions(), prllxBackgroundImages);
                    ground = new Ground(getStageDimesions(), groundImages);

                    character = new Character(getStageDimesions(), characterSprite, 1);
                    character.startRunning();

                    hud = new Hud(getStageDimesions());
                    powerBar = new Powerbar(getStageDimesions());

                    basket = new Basket(getStageDimesions(), speed);

                    stage.addChild(prllxBackground, ground, basket, character, hud, powerBar);
                }
            }
        }
    }

    // Dispatches GameOver event and resets whole game + removes tick event (so game doesn't restart)
    function stopGame() {

        console.log('stopGame');

        character.restart();

        createjs.Ticker.off("tick", _ticklistener);

        document.dispatchEvent(event);
    }

    // Restart by readding tick event
    function restart() {

        console.log('restart');

        // createjs.Ticker.on("tick", _ticklistener);
    }

    /*
    *
    * Events
    *
    */

    function stageMouseMove(e) {

        if (character.armCanMove) character.calculateAndMoveArmAngle(getCursorOnStage(e));
    }

    function stageMouseUp(e) {

        // console.log('stageMouseUp');

        // If arm can move lock arm and show shooting bar
        if (character.armCanMove) {

            console.log('armCanMove');

            character.calculateAndMoveArmAngle(getCursorOnStage(e));
            character.armCanMove = false;

            powerBar.showPowerBar();

        // If power bar is shown and there is no ball throw a new ball
        } else if (powerBar.isShown && !ball) {

            console.log('Create Ball');
            
            powerBar.lockPowerBar();

            ball = new Ball(getStageDimesions(), character.getArmPos(), basket.getScoreArea(), character.shootingAngle, powerBar.shootingPower);
            stage.addChild(ball);

        } else
            character.jump(250);
    }

    function onTick(e) {

        var basketStatus = basket.tick();
        // console.log(basketStatus);

        if (basketStatus === 'new')
            ground.flatland = true;

        else if (basketStatus === 'first_pause')
            character.setToShoot();

        else if (basketStatus !== 'paused') {

            if(Math.round(new Date().getTime()) % 10 == 0) player.addScore(1);
            ground.move(speed);
            prllxBackground.move(speed);

            _checkCollision();
        }

        // If there is a ball move it and hit test with basket
        if (ball) {
            
            ball.moveThrow(e.delta);
            
            // If ball either missed or scored: remove ball, reset arm and stop flatland (restart obstacle and ravine generation)
            var ballHit = ball.hit();
            if (ballHit) {

                if (ballHit == 'goal') player.addScore(10);
                else if (ballHit == 'miss') player.addScore(-10);

                character.resetArm(0);

                stage.removeChild(ball);
                ball = undefined;
                
                basket.didShoot = true;

                ground.flatland = false;

                powerBar.hidePowerBar();
            }
        }

        hud.updateScore(player.getScore());

        // Nested function that check wether obstacle or ground is hit
        function _checkCollision() {

            // Check if character is on the ground else fall down
            var groundTiles = ground.getCurrentGroundTiles(),
                groundIntersection = false;

            for (var i = 0; i < groundTiles.length; i++)
                if (ndgmr.checkPixelCollision(character.body, groundTiles[i], 0, true)) groundIntersection = true;

            if (groundIntersection)
                character.startRunning();
            else {
                character.fall(10);
                character.stopRunning();
            }

            // Check if character hits obstacle or has fallen in ravine
            var obstacles = ground.getObstacles(),
                obstacleIntersection = false;

            for (var i = 0; i < obstacles.length; i++) 
                if (ndgmr.checkPixelCollision(character.body, obstacles[i], 0, true)) obstacleIntersection = true;
            
            // Stop game if character hits either obstacle or ground
            if (obstacleIntersection || ndgmr.checkPixelCollision(character.body, ground.ravineBottom, .5)) stopGame();
        }

        stage.update();
    }

    /*
    *
    * End of Events
    *
    * * 
    *
    * Helper Functions 
    *
    */

    // Returns player so player can be configured outside game before start
    // + so score can be accessed
    this.getPlayer = function() {

        return player;
    };

    // Returns current width and height of CreateJS stage
    function getStageDimesions() {

        return stageDimesions = {
            width: stage.canvas.width,
            height: stage.canvas.height
        };
    }

    // Returns cursor point in stage
    function getCursorOnStage(e) {

        return { 
            "x": e.stageX, 
            "y": e.stageY 
        };
    }

    /*
    *
    * End of Helper Functions
    *
    */

};