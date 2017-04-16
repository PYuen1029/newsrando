module.exports = function($http) {
	var get = function() {
		return $http.get('/api/politician', {cache: true});
	};

	return {
		// returns a promise
		get: get
	};
};