/*
* 
* 	PrllxBackground.js
* 
* 	Created by Dries Van Schevensteen on 12/03/15.
*
*/

(function() {

	var frontTiles = [], middleTiles = [], backTiles = [],
		frontTilesContainer = new createjs.Container(), middleTilesContainer = new createjs.Container(), backTilesContainer = new createjs.Container();

	function PrllxBackground(stageDimesions, images) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;
		this.images = images;

		this.setup();
	}

	var p = createjs.extend(PrllxBackground, createjs.Container);

	p.setup = function() {

		// Create first 2 front, middle and back tiles
		for (var i = 0; i < 2; i++) {
			var front = new createjs.Bitmap(this.images.front[0]);
			var frontWidth = front.getBounds().width;
			front.x = 0 + i*frontWidth - i*10;

			frontTiles.push(front);
			frontTilesContainer.addChild(front);

			var middle = new createjs.Bitmap(this.images.middle[0]);
			var middleWidth = middle.getBounds().width;
			middle.x = 0 + i*middleWidth - i*10;

			middleTiles.push(middle);
			middleTilesContainer.addChild(middle);

			var back = new createjs.Bitmap(this.images.back[0]);
			var backWidth = back.getBounds().width;
			back.x = 0 + i*backWidth - i*10;

			backTiles.push(back);
			backTilesContainer.addChild(back);
		}

		this.addChild(backTilesContainer, middleTilesContainer, frontTilesContainer);
	};

	p.move = function(x) {
		
		frontTilesContainer.x -= x;
		middleTilesContainer.x -= x/2;
		backTilesContainer.x -= x/4;

		//Create front tile if necessary
		var lastFrontTileX = frontTiles[frontTiles.length-1].x;
		if (frontTilesContainer.x + lastFrontTileX < this.stageDimesions.width) {

			// console.log('Create new frontTile');

			var front = new createjs.Bitmap(this.images.front[0]);

			var frontWidth = front.getBounds().width;
			front.x = lastFrontTileX + frontWidth - 10;

			frontTiles.push(front);
			frontTilesContainer.addChild(front);
		}

		//Create middle tile if necessary
		var lastMiddleTile = middleTiles[middleTiles.length-1].x;
		if (middleTilesContainer.x + lastMiddleTile < this.stageDimesions.width) {

			// console.log('Create new middleTile');

			var middle = new createjs.Bitmap(this.images.middle[0]);

			var middleWidth = middle.getBounds().width;
			middle.x = lastMiddleTile + middleWidth - 10;

			middleTiles.push(middle);
			middleTilesContainer.addChild(middle);
		}

		//Create back tile if necessary
		var lastBackTile = backTiles[backTiles.length-1].x;
		if (backTilesContainer.x + lastBackTile < this.stageDimesions.width) {

			// console.log('Create new backTile');

			var back = new createjs.Bitmap(this.images.back[0]);

			var middleWidth = back.getBounds().width;
			back.x = lastBackTile + middleWidth - 10;

			backTiles.push(back);
			backTilesContainer.addChild(back);
		}
	};

	window.PrllxBackground = createjs.promote(PrllxBackground, "Container");

}());