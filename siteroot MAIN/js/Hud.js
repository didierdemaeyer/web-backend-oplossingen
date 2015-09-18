/*
 *
 * 	Hud.js
 *
 * 	Created by Dries Van Schevensteen on 21/02/15.
 *
 */

(function() {

    function Hud(stageDimesions) {

        this.Container_constructor();

        this.stageDimesions = stageDimesions;

        this.setup();
    }

    var p = createjs.extend(Hud, createjs.Container);

    p.setup = function() {

        var bg = new createjs.Shape();
        bg.graphics.beginFill('purple').drawRect(10, 10, 130, 32);

        this.scoreText = new createjs.Text('Score: 0', '20px Helvetica-Neue, Arial, Sans-Serif', 'white');
        this.scoreText.x = 15;
        this.scoreText.y = 15;

        this.addChild(bg, this.scoreText);
    };

    p.updateScore = function(score) {
        this.scoreText.text = 'Score: ' + score;
    };

    window.Hud = createjs.promote(Hud, 'Container');

}());