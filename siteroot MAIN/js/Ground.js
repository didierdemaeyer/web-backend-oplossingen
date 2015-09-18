/*
* 
* 	Ground.js
* 
* 	Created by Dries Van Schevensteen on 08/04/15.
*
*/

(function() {

	var tiles = [],
		tilesContainer = new createjs.Container(),
		obstacles = [],
		nextObstacle, nextAirTile;

	function Ground(stageDimesions, images) {

		this.Container_constructor();

		this.stageDimesions = stageDimesions;
		this.images = images;

		this.flatland = false;

		nextObstacle = this.generateRandomTime(1, 1);
		nextAirTile = this.generateRandomTime(1, 1);

		this.setup();
	}

	var p = createjs.extend(Ground, createjs.Container);

	p.setup = function() {
		
		// Create first 5 tiles, which can only be floor no ravine
		for (var i = 0; i < 5; i++) {
			var floor = new createjs.Bitmap(this.images.ground);
			floor.type = 'ground';

			var floorWidth = floor.getBounds().width;

	        floor.x = 0 + i*floorWidth - i*10;

	        tiles.push(floor);
	        tilesContainer.addChild(floor);
		}

		tilesContainer.x = 0;
		tilesContainer.y = this.stageDimesions.height - tiles[0].getBounds().height/2;

		// Ravine bottom to check wheter player is dead or not
		this.ravineBottom = new createjs.Bitmap(this.images.ravine);
		this.ravineBottom.y = this.stageDimesions.height;

		this.addChild(this.ravineBottom, tilesContainer);

		console.log();
	};

	p.generateRandomTime = function(minInSeconds, maxInSeconds) {
		
		return new Date().getTime() + minInSeconds*1000 + (Math.random() * (maxInSeconds - minInSeconds)*1000);
	};

	p.reset = function() {
		tiles = [];
		obstacles = [];
	};

	p.move = function(x) {
		
		tilesContainer.x -= x;

		var lastFloorTileX = tiles[tiles.length-1].x;
		
		// Create floor tile at random time
		if (tilesContainer.x + lastFloorTileX < this.stageDimesions.width) 
			this.createFloorTile(lastFloorTileX);

		// Remove last floor tile if off screen
		if (tilesContainer.x + tiles[0].x < -tiles[0].getBounds().width) 
			this.removeLastFloorTile();

		// Creates obstacle at random time and location
		if (tilesContainer.x + lastFloorTileX < this.stageDimesions.width &&
			new Date().getTime() > nextObstacle && !this.flatland) 
			this.createObstacle();

		// Remove last obstacle if off screen
		if (obstacles[0] && 
			tilesContainer.x + obstacles[0].x < -obstacles[0].getBounds().width)
			this.removeLastObstacle();
	};

	p.createFloorTile = function(lastFloorTileX) {

		var isAir = 
			new Date().getTime() > nextAirTile && 
			!this.flatland && 
			tiles[tiles.length-1].type !== 'air';

		if (isAir) nextAirTile = this.generateRandomTime(3, 6);

		var floor = new createjs.Bitmap(this.images[(isAir) ? 'air' : 'ground']);
		floor.type = (isAir) ? 'air' : 'ground';
        floor.x = lastFloorTileX + floor.getBounds().width - 1;

        tiles.push(floor);
        tilesContainer.addChild(floor);
	};

	p.removeLastFloorTile = function() {

		tilesContainer.removeChild(tiles[0]);
		tiles.shift();
	};

	p.createObstacle = function() {

		nextObstacle = this.generateRandomTime(6, 8);

		var obstacle = new createjs.Bitmap(this.images.boxes[0]);
		obstacle.x = Math.abs(tilesContainer.x) + this.stageDimesions.width;
		obstacle.y = -obstacle.getBounds().height - 10;

		obstacles.push(obstacle);
		tilesContainer.addChild(obstacle);
	};

	p.removeLastObstacle = function() {

		tilesContainer.removeChild(obstacles[0]);
		obstacles.shift();
	};

	// Returns tiles below player
	p.getCurrentGroundTiles = function() {
		return [tiles[0], tiles[1]];
	};

	// Returns obstacles
	p.getObstacles = function() {
		return obstacles;
	};

	window.Ground = createjs.promote(Ground, "Container");

}());