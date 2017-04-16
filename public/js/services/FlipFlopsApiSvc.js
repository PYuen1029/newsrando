module.exports = function($http, $location) {
	var FlipFlopsApiSvc = function() {
		var post = function(data) {
			// $http to post data to api/store
			return $http.post('api/flipflop', data);
		};

		var destroy = function() {
			//  $.ajax to DELETE data to api/destroy
			console.log('FlipFlopsApiSvc.js: Line 5 -- deleted flipflop data');
		};

		return {
			post: post,
			destroy: destroy
		};
		
	};

	return new FlipFlopsApiSvc();
};