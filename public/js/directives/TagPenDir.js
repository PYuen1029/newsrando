module.exports = function(GetTagsSvc) {
	return {
		restrict: 'E',
		replace: true, // Replace with the template below
		scope: {
			filters:"="
		},
		link: function(scope, element, attrs) {
			scope.buttons = GetTagsSvc.getTags();

			scope.toggleButton = function(button) {
				button.on = !button.on;
				
				scope.filters = [];

				angular.forEach(
					scope.buttons.filter(function(obj){
						return obj.on === true;
					}),
					function(value, key) {
						this.push(value.value);
					},
					scope.filters
				);
			};			
		},
		templateUrl: '/js/directives/tagPen.html' // See below
	};
};