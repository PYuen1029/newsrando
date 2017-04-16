module.exports = function($http) {
	var addNewsSource = function(url) {
		var addNewsSourcePromise = 
			$http({
				method: 'POST',
				url: 'newssource',
				data: {
					newsSourceUrl: url
				}
			});

		return addNewsSourcePromise;
	};

	var deleteNewsSource = function(id) {
		// it needs to get the data
		var deleteNewsSourcePromise = $http.delete('newssource/' + id);

		return deleteNewsSourcePromise;
		// LEFT OFF

	};

	return {
		deleteNewsSource: deleteNewsSource,
		addNewsSource: addNewsSource
	};
};