module.exports = function($scope) {
	$scope.user = window.user;
	
	angular.element(document).ready(function () {
		$('#home__website-thumbs').slickLightbox();
	});
};