module.exports = function($scope, $http, NewsSourceSvc) {
	$('.modal').modal();

	$scope.user = window.user;

	$scope.openAddNewsSourceModal = function(evt) {
		$('#addNewsSourceModalWrapper').modal('open');
	};

	$scope.submitNewsSource = function(evt) {
		// get url

		var newsSourceUrl = $(evt.target).closest('#addNewsSourceModalWrapper').find("[name='newsSourceUrl']").val();

		// pass it to NewsSource service api to create
		var addNewsSourcePromise = NewsSourceSvc.addNewsSource(newsSourceUrl);

		addNewsSourcePromise.then(
			function successCallback(data) {
				$scope.user.newsSources = data.data;
			},
			function errorCallback(data) {
				// return a notification that it didn't work
				// window.swal("Here's a message");
				swal({
					title: "Error!",
					text: "The URL you provided was not valid!",
					type: "error",
					confirmButtonText: "Okay"
				});
			}
		);
		
	};

	$scope.deleteNewsSource = function(evt) {
		var id = $(evt.target).data('delete-id');

		var deleteNewsSourcePromise = NewsSourceSvc.deleteNewsSource(id);

		deleteNewsSourcePromise.then(
			function successCallback(data) {
				$scope.user.newsSources = data.data;
			},
			function errorCallback(data) {
				swal({
					title: "Error!",
					text: "There was an error!",
					type: "error",
					confirmButtonText: "Okay"
				});
			}
		);
	};
};