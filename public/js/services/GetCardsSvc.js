// GetCardsSvc will create all the cards
module.exports = function($http, CardFcty) {
	var getCards = function() {
		var cards = [];
		
		// it needs to get the cards promise
		var cardsPromise = $http.get('/api/flipflop', {cache: true});

		// when the promise resolves, add to cards
		cardsPromise.then(
			// SUCCESS
			function(data) {
				for(var i = 0; i < data.data.length; i++) {
					cards.push(CardFcty.create(data.data[i]));
				}
			},
			function(data) {
				console.log('GetCardsSvc.js: Line 16 -- failure:');
				console.dir(data);
			}
		);

		return cards;
	};

	return {
		getCards: getCards
	};
};