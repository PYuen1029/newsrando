module.exports = function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			element.css({
				'background-image': 'url(' + scope.background +')',
				'background-size' : 'cover'
			});
		},
		templateUrl: '/js/directives/modalDialog.html' // See below
	};
};