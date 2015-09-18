/*
* 
* 	Basket.js
* 
* 	Created by Dries Van Schevensteen on 21/02/15.
*
*/

(function() {

	var basket, pole;

	// didAddBasket is true when a basket is created and added to the stage
	var didAddBasket = false;

	// didPause is true when the basket is paused on screen so user can throw at basket
	var didPause = false;

	// Random time when a new basket needs to be created
	var nextBasket;

	function Basket(stageDimesionsn, speed) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;

		this.speed = 5;

		// didShoot is true when user scored or missed
		this.didShoot = false;
		
		nextBasket = this.generateRandomTime(2, 5);

		this.setup();
	}

	var p = createjs.extend(Basket, createjs.Container);

	p.setup = function() {

		basket = new createjs.Shape();
		basket.graphics.beginFill("pink").drawRect(0, 0, 70, 35);
		basket.y = this.stageDimesions.height - 275;
		basket.width = 70;
		basket.height = 35;
		
		pole = new createjs.Shape();
		pole.graphics.beginFill("pink").drawRect(0, 0, 20, 250);
		pole.y = this.stageDimesions.height - 270;

		this.resetBasket();
	};

	p.generateRandomTime = function(minInSeconds, maxInSeconds) {

		return new Date().getTime() + minInSeconds*1000 + (Math.random() * (maxInSeconds - minInSeconds)*1000);
	};

	p.move = function(speed) {

		basket.x -= speed;
		pole.x -= speed;
	};

	// If basket is not onscreen from right return true
	p.shouldMoveOnScreen = function() {

		if (basket.x > this.stageDimesions.width - 150)
			return true;
		return false;
	};

	// If basket is offscreen from left return true
	p.basketOffScreen = function () {

		if (basket.x < -150)
			return true;
		return false;
	};

	// Move backset back to right and remove form stage, reset all variables
	p.resetBasket = function() {

		nextBasket = this.generateRandomTime(2, 5);
		this.didShoot = false;
		didAddBasket = false;
		didPause = false;

		basket.x = this.stageDimesions.width*2.5;
		pole.x = this.stageDimesions.width*2.5 + 70;
		this.removeChild(basket, pole);
	};

	// Returns area of basket
	p.getScoreArea = function() {
		return {
			x: basket.x,
			y: basket.y,
			width: basket.width,
			height: basket.height
		};
	};

	p.tick = function() {

		// If there is no basket on screen, add one if time is greater then next planned basket placement
		if (!didAddBasket) {

			if (new Date().getTime() > nextBasket) {

				this.addChild(basket, pole);
				didAddBasket = true;
				return 'new';
			}

			return 'no_basket';
		}

		// If there is a basket on screen either move, pause or reset it
		if (didAddBasket) {

			// If user did not shoot yet move basket on screen and pause when on screen
			if (!this.didShoot) {

				if (this.shouldMoveOnScreen()) {
					this.move(this.speed);
					return 'move_in';
				}

				// Return first_pause only once, after that return pause
				if (didPause === false) {
					didPause = true;
					return 'first_pause';
				} else
					return 'paused';
			}

			// If basket is offScreen reset basket
			if (this.basketOffScreen()) {

				this.resetBasket();
				return 'off_screen';
			}

			// If user did shoot at basket move basket off screen
			if (this.didShoot) {
				
				this.move(this.speed);
				return 'move_out';
			}
		}
	};

	window.Basket = createjs.promote(Basket, "Container");

}());