/*
* 
* 	Ball.js
* 
* 	Created by Dries Van Schevensteen on 21/02/15.
*
*/

(function() {

	function Ball(stageDimesions, position, scoreArea, angle, power) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;

		this.position = position;
        this.angle = angle;
        this.power = power;

		this.scoreArea = scoreArea;

		this.isMoving = true;
		this.startedMoving = true;

		this.setup();
	}

	var p = createjs.extend(Ball, createjs.Container);

	p.setup = function() {

		var ball = new createjs.Shape();
		ball.graphics.beginFill("purple").drawCircle(0, 0, 10);
        
        ball.startPos = this.position;
		ball.x = this.position.x;
		ball.y = this.position.y;

		ball.width = ball.height = 100;

        ball.ticktime = 0;
        
        var initialAngle = this.angle * (Math.PI / 180);
		ball.velocity_x = Math.cos(initialAngle) * this.power;
		ball.velocity_y = Math.sin(initialAngle) * this.power;

        this.ball = ball;
		this.addChild(this.ball);
	};

	p.moveThrow = function(delta) {

        this.ball.ticktime += delta / 1000 * 10;
        
        this.ball.x = this.ball.startPos.x + this.ball.velocity_x * this.ball.ticktime;
        this.ball.y = this.ball.startPos.y + (this.ball.velocity_y * this.ball.ticktime) -
        				(0.5 * (-9.81) * Math.pow(this.ball.ticktime, 2));
	};

	p.hit = function() {

		if (this.ball.x < -10 || 
        	this.ball.x > this.stageDimesions.width + 10 || this.ball.y > this.stageDimesions.height + 10)
        	return 'miss';

        if ((this.ball.x > this.scoreArea.x && this.ball.x < this.scoreArea.x + this.scoreArea.width) &&
        	(this.ball.y > this.scoreArea.y && this.ball.y < this.scoreArea.y + this.scoreArea.height))
        	return 'goal';

        return false;
	};

	window.Ball = createjs.promote(Ball, "Container");

}());