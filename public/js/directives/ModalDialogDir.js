module.exports = function() {
	return {
		restrict: 'E',
		replace: true, // Replace with the template below
		link: function(scope, element, attrs) {
			scope.dialogStyle = {};
			if (attrs.width)
				scope.dialogStyle.width = attrs.width;
			if (attrs.height)
				scope.dialogStyle.height = attrs.height;
		},
		templateUrl: '/js/directives/modalDialog.html' // See below
	};
};