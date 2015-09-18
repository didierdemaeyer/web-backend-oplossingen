/*
* 
* 	Powerbar.js
* 
* 	Created by Dries Van Schevensteen on 08/04/15.
*
*/

(function() {

	// Slider and background rects to show, command is used for tweening between min and max power
	var slider, sliderCommand, background;

	// Dimesions are width (unmapped max power) and height
	var dimensions = {};

	function Powerbar(stageDimesions) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;

		// True if powerbar is on screen
		this.isShown = false;

		this.shootingPower = 0;

		dimensions = {
			width: 200,
			height: 20,
			bgOffeset: 2
		};

		this.setup();
	}

	var p = createjs.extend(Powerbar, createjs.Container);

	p.setup = function() {

		slider = new createjs.Shape();
		slider.graphics.beginFill('blue')
		sliderCommand = slider.graphics.drawRect(
				this.stageDimesions.width/2 - dimensions.width/2, 10,
				0, dimensions.height
			).command;

		background = new createjs.Shape();
		background.graphics.beginFill('orange').drawRect(
				this.stageDimesions.width/2 - dimensions.width/2 - dimensions.bgOffeset, 10 - dimensions.bgOffeset,
				dimensions.width + dimensions.bgOffeset*2, dimensions.height + dimensions.bgOffeset*2
			);
	};

	// Shows powerBar whilst sliding from unmapped min to -max value
	p.showPowerBar = function() {

		sliderCommand.w = 0;

		createjs.Tween.get(sliderCommand, { loop: true })
			.to({ w: dimensions.width }, 900, createjs.Ease.getPowInOut(1))
			.to({ w: 0 }, 1000, createjs.Ease.getPowInOut(1));

		this.addChild(background, slider);
		this.isShown = true;
	};

	p.hidePowerBar = function() {
		
		this.removeChild(background, slider);
		this.isShown = false;
	};

	// Locks powerBar to current position
	p.lockPowerBar = function() {

		var currentPower = sliderCommand.w;
		createjs.Tween.removeTweens(sliderCommand);
		sliderCommand.w = currentPower;
		
		this.calcuateShootingPowerInPercent(currentPower, 0, dimensions.width);
	};

	// Calculates a percentage of the current slider with compared to the total with
	p.calcuateShootingPowerInPercent = function(unmappedPower, min, max) {

		var max = max - min,
			unmappedPower = unmappedPower - min,
			min = 0;
		this.shootingPower = unmappedPower * (100/max);
	};

	window.Powerbar = createjs.promote(Powerbar, "Container");

}());