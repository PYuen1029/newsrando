module.exports = function($http) {
	var check = function(newsSources) {
		// check each $newsSources if the updated_at is recent
		angular.forEach(newsSources, function(value){
			
			if(!this.checkIfFrontpageWasUpdatedRecently(value)) {
				this.update(value.id);
			}
		}.bind(this) );
	};

	var update = function(id) {
		// sends backend API call to update the specific news source by ID
		$http({
			method: 'PUT',
			url: 'frontpage/' + id,
		}).then(
			function successCallback(data) {
				console.log('FrontpageSvc.js: Line 19 -- data:');
				console.dir(data);
			},
			function errorCallback(data) {
				console.log('data');
				console.dir(data);
			}
		);
	};

	var checkIfFrontpageWasUpdatedRecently = function(newsSource) {
		var now = new Date();
		var nowCheck = now.setHours(now.getHours() - 1);
		var then = new Date(newsSource.updated_at);

		return nowCheck < then;
		
	};

	return {
		check: check,
		update: update,
		checkIfFrontpageWasUpdatedRecently: checkIfFrontpageWasUpdatedRecently
	};
};