module.exports = function($scope, GetPoliticiansSvc) {
	var politiciansPromise = GetPoliticiansSvc.get();
	politiciansPromise.then(function(data) {
		$scope.politicians = data.data;

		$('.loader-item').fadeOut(); 
		$('#pageloader').delay(1000).fadeOut('slow');
		$('body').delay(1000).css({'overflow-y':'visible'});
	});

	$scope.tagList = function(tags) {
		tagNames = tags.map(function(val) {return val.tag;});
		return tagNames.join(' - ');

	};
	
};