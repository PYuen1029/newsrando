// GetTagsSvc will create all the tags
module.exports = function($http, tagFcty) {
	var getTags = function() {
		var tags = [];
		
		// it needs to get the tags promise
		var tagsPromise = $http.get('/api/tag', {cache: true});

		// when the promise resolves, add to tags
		tagsPromise.then(
			// SUCCESS
			function(data) {
				for(var i = 0; i < data.data.length; i++) {
					tags.push({
						value: data.data[i].tag,
						id: data.data[i].id,
						on: false
					});
				}

				$('.loader-item').fadeOut(); 
				$('#pageloader').delay(1000).fadeOut('slow');
				$('body').delay(1000).css({'overflow-y':'visible'});
			},
			function(data) {
				console.log('GetTagsSvc.js: Line 16 -- failure:');
				console.dir(data);
			}
		);

		return tags;
	};

	return {
		getTags: getTags
	};
};