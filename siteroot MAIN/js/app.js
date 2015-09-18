/*
* 
* 	main.js
* 
* 	Created by Dries Van Schevensteen on 04/03/15.
*
*/

"use strict";

(function(){

	console.log('Main.js Loaded');

	var game = new Game();

	var app = angular.module('korfball-game', [])

	// viewController that switches between all seperate views

	.controller('viewController', ['$scope', function($scope) {
		$scope.views = ['intro', 'country', 'gender', 'game', 'gameover', 'scores', 'howto'];
		$scope.view = $scope.views[0];
		
		$scope.switchToView = function(viewName) {
			var viewIndex = $scope.views.indexOf(viewName);
			$scope.view = (viewIndex !== -1) ? $scope.views[viewIndex] : $scope.views[0];
		};
	}])

	// All views in separate directive with controller

	.directive('intro', function($rootScope) {
		return {
			restrict: 'E',
			templateUrl: 'views/intro.html',
			controller: ['$scope', function($scope) {

				console.log('introController');

				$scope.submit = function() {
					if ($scope.introForm.$valid) {
						game.getPlayer().setName($scope.name);
						$scope.$parent.switchToView('country');
					}
				};

			}],
			controllerAs: 'intro'
		};
	})

	.directive('countries', function() {
		return {
			restrict: 'E',
			templateUrl: 'views/countries.html',
			controller: ['$scope', function($scope) {

				console.log('countriesController');

				var countries = game.getPlayer().getCountries();
				$scope.countries = countries;
				$scope.countryCode = 'BE';

				$scope.submit = function() {
					if ($scope.countryForm.$valid) {
						game.getPlayer().setCountry($scope.countryCode);
						$scope.$parent.switchToView('gender');
					}
				};

			}],
			controllerAs: 'countries'
		};
	})

	.directive('gender', function() {
		return {
			restrict: 'E',
			templateUrl: 'views/gender.html',
			controller: ['$scope', function($scope) {

				console.log('genderController');

				$scope.selectGender = function(gender) {
					game.getPlayer().setGender(gender);
					$scope.$parent.switchToView('game');
				};

			}],
			controllerAs: 'gender'
		};
	})

	.directive('game', function($rootScope) {
		return {
			restrict: 'E',
			templateUrl: 'views/game.html',
			controller: ['$scope', function($scope) {

				console.log('gameController');

				// Goto gameOver view if game calls gameOver event
				document.addEventListener('gameOver', function (e) {
					$scope.$apply(function () {
						$scope.$parent.switchToView('gameover');
			        });
				});

				game.startGame();

			}],
			controllerAs: 'game'
		};
	})

	.directive('gameover', function($rootScope, $http) {
		return {
			resize: 'E',
			templateUrl: 'views/gameover.html',
			controller: ['$scope', function($scope){
				
				console.log('gameOverController');

				$scope.player = game.getPlayer();

				$http.post('api/postscore.php?name=' + $scope.player.name + '&score=' + 301 + '&country=' + $scope.player.country.name).
					success(function(data) {
						console.log(data);
					});

				$scope.replay = function() {
					$scope.$parent.switchToView('game');
				};

				$scope.showScores = function() {
					$scope.$parent.switchToView('scores');
				};
				
			}],
			controllerAs: 'gameOver'
		}
	})

	.directive('scores', function($rootScope, $http) {
		return {
			restrict: 'E',
			templateUrl: 'views/scores.html',
			controller: ['$scope', function($scope) {

				console.log('scoresController');

				$scope.back = function() {
					$scope.$parent.switchToView('gameover');
				};

				$http.get('api/scores.php?top=10&abovelying=5&underlying=5').
					success(function(data) {
						// console.log(data);
						$scope.scores = data;
						$scope.scores.me = data.abovelying.concat(data.me, data.underlying);
					});

			}],
			controllerAs: 'scores'
		};
	})

	.directive('howto', function($rootScope) {
		return {
			restrict: 'E',
			templateUrl: 'views/howto.html',
			controller: ['$scope', function($scope) {

				console.log('howtoController');

			}],
			controllerAs: 'howto'
		};
	});

})();