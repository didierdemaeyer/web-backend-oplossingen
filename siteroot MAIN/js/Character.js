/*
* 
* 	Character.js
* 
* 	Created by Dries Van Schevensteen on 20/02/15.
*
*/

(function() {

	var body, arm, armHandle,
		isRunning = false, canJump = false;
		

	function Character(stageDimesions, sprite, runningSpeed) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;
		this.sprite = sprite;

		this.armCanMove = false;
		this.didShoot = false;

		this.shootingAngle = 0;

		this.runningSpeed = runningSpeed;

		this.setup();
	}

	var p = createjs.extend(Character, createjs.Container);

	p.setup = function() {

		var floatToFall = 200;

		var data = {
			images: [this.sprite],
			frames: {
				width: 120, //6
				height: 148, //5
				count: 30,
				regX: 60,
				regY: 148
			},
			animations: {
				run: [0, 29, 'run', this.runningSpeed],
				still: 17,
			}
		};

		var characterSpriteSheet = new createjs.SpriteSheet(data);

		body = new createjs.Sprite(characterSpriteSheet, 'still');
		body.x = 100;
		body.y = this.stageDimesions.height - 45 - floatToFall;

		arm = new createjs.Shape();
		arm.graphics.beginFill("green").drawRect(0, 0, 80, 10);
		arm.rotation = 0;
		arm.regY = 5;
		arm.x = 110;
		arm.y = this.stageDimesions.height - 150 - floatToFall;

		this.addChild(body, arm);

		this.body = body;
	};

	p.restart = function() {

		body.y = this.stageDimesions.height - 45 - 500;
		arm.y = this.stageDimesions.height - 150 - 500;
	};

	p.setToShoot = function() {

		this.stopRunning();
    	this.armCanMove = true;
	};

	p.stopRunning = function() {

		if(isRunning) {
			body.gotoAndPlay('still');
			isRunning = false;
			canJump = false;
		}
	};

	p.startRunning = function() {

		if (!isRunning) {
			body.gotoAndPlay('run');
			isRunning = true;
			canJump = true;
		}
	};

	p.fall = function(speed) {

		body.y += speed;
		arm.y += speed;
	};

	p.jump = function(height) {
		
		if (canJump) {
			
			console.log('jump');

			canJump = false;

			createjs.Tween.get(body).to({
	            y: (body.y - height)
	        }, 1000, createjs.Ease.quadOut).to({
	            y: (body.y - 7)
	        }, 1000, createjs.Ease.quadIn)
	        .call(function(){
	        	canJump = true;
	        });

	        createjs.Tween.get(arm).to({
	            y: (arm.y - height)
	        }, 1000, createjs.Ease.quadOut).to({
	            y: (arm.y - 7)
	        }, 1000, createjs.Ease.quadIn);
    	}
	};

	// Calculates shooting angle and calls rotate arm with shooting angle
	p.calculateAndMoveArmAngle = function(p2) {

		deltaY = p2.y - arm.y;
		deltaX = p2.x - arm.x;

		this.shootingAngle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;
		this.rotateArm(this.shootingAngle);
	};

	// Sets arm to given angle, with human arm rotation limitations
	p.rotateArm = function(angle) {

		if (angle < 90 && angle > -90) arm.rotation = angle;
		else if (angle > 90) {
			arm.rotation = 90;
			this.shootingAngle = 90;
		}
		else if (angle < -90) {
			arm.rotation = -90;
			this.shootingAngle = -90;
		}
	};

	p.getArmPos = function() {

		return {
			x: arm.x,
			y: arm.y
		};
	};

	// Reset arm to given angle
	p.resetArm = function(angle) {

		this.didShoot = true;

		createjs.Tween.get(arm).to({
	        rotation: angle
	    }, 400, createjs.Ease.quadOut)
	    .call(function(){
	    	arm.rotation = angle;
	    	this.shootingAngle = angle;
	    });
	};

	window.Character = createjs.promote(Character, "Container");

}());