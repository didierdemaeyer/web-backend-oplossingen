/*
* 
* 	Player.js
* 
* 	Created by Dries Van Schevensteen on 04/04/15.
*
*/

var Player = function() {

	var score = 0, 
		GENDERS = {
			M: {id: 0, name: 'Male'},
			F: {id: 1, name: 'Female'}
		}, 
		COUNTRIES = {
			BE: {id: 0, name: 'Belgium', countryCode: 'BE'},
			NE: {id: 1, name: 'The Netherlands', countryCode: 'NE'},
			BR: {id: 2, name: 'Brazil', countryCode: 'BR'},
			PO: {id: 3, name: 'Portugal', countryCode: 'PO'},
			EN: {id: 4, name: 'England', countryCode: 'EN'},
			CR: {id: 5, name: 'Czech Republic', countryCode: 'CR'},
			RU: {id: 6, name: 'Russia', countryCode: 'RU'},
			HU: {id: 7, name: 'Hungary', countryCode: 'HU'},
			PL: {id: 8, name: 'Poland', countryCode: 'PL'},
			CA: {id: 9, name: 'Catalonia', countryCode: 'CA'},
			GE: {id: 10, name: 'Germany', countryCode: 'GE'},
			TA: {id: 11, name: 'Taiwan', countryCode: 'TA'},
			AU: {id: 12, name: 'Australia', countryCode: 'AU'},
			CH: {id: 13, name: 'China', countryCode: 'CH'},
			HO: {id: 14, name: 'Hongkong', countryCode: 'HO'},
			SA: {id: 15, name: 'South-Africa', countryCode: 'SA'}
		};
	
	this.name = 'No Name';
	this.gender = GENDERS.M;
	this.country = COUNTRIES.BE;

	// Returns array of countries with name and countryCode
	this.getCountries = function() {
		countries = [];
		for (var c in COUNTRIES)
		    countries.push({ 
				'name': COUNTRIES[c].countryCode, 
				'countryCode': COUNTRIES[c].name 
			});
		return countries;
	};

	this.setName = function(name) {
		this.name = name;
		console.log(this.name);
	}

	this.setGender = function(gender) {
		this.gender = (gender == 'female') ? GENDERS.F : GENDERS.M;
		console.log(this.gender.name);
	};

	this.setCountry = function(countryCode) {
		this.country = (countryCode in COUNTRIES) ? COUNTRIES[countryCode] : COUNTRIES.BE;
		console.log(this.country.name);
	};

	// Score methods
	this.getScore = function() {
		return score;
	};

	this.addScore = function(scoreToAdd) {
		if (scoreToAdd) score += scoreToAdd;
	};

	this.resetScore = function() {
		score = 0;
	};

}