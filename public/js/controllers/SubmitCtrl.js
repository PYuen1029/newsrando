module.exports = function($scope, $http, FlipFlopsApiSvc, GetPoliticiansSvc, $location) {
	
	var politiciansPromise = GetPoliticiansSvc.get();
	
	politiciansPromise.then(function(data) {
		$scope.politicians = data.data;

		$('.loader-item').fadeOut(); 
		$('#pageloader').delay(1000).fadeOut('slow');
		$('body').delay(1000).css({'overflow-y':'visible'});
	});

	$scope.flipflopCreate = function() {
		// get data
		var data = {
			title: $('#submit__title').val(),
			summary: $('#submit__summary').val(),
			sourceType: $('input[name="submit__source-type"]:checked').val(),
			flip: $('input[name="submit__flip"]').val(),
			flop: $('input[name="submit__flop"]').val(),
			politician: $scope.selectedPolitician.id
		};

		// if type is text, also include flipText and flopText
		if(data.sourceType == 'text') {
			data.flip_source = $('#submit__flip-source').val();
			data.flop_source = $('#submit__flop-source').val();
			data.flip = $('textarea[name="submit__flip"]').val();
			data.flop = $('textarea[name="submit__flop"]').val();
			data.flop_source = $('#submit__flop-source').val();
		}

		// if type is video, append youtube time if it's set
		if(data.sourceType == 'youtube') {
			var flipTimeString = $('#submit__flip-yt-time').val();
			
			var re = /(\d{2})/gi;

			if(flipTimeString) {
				var matches1 = flipTimeString.match(re);

				data.flip += "&t=" + matches1[0] + 'm' + matches1[1] + 's';
			}

			var flopTimeString = $('#submit__flop-yt-time').val();
			if(flopTimeString) {
				var matches2 = flopTimeString.match(re);

				data.flop += "&t=" + matches2[0] + 'm' + matches2[1] + 's';
			}
		}

		FlipFlopsApiSvc.post(data).then(function(data){
			if (data) {
				$location.path('/');
			}
		});
	};

	// handle sourceType radio buttons on change
	$scope.type = 'youtube';
	$scope.typeText = 'Youtube';
	
	$scope.changeForm = function(type) {
		switch (type) {
			case 'text':
				$scope.typeText = 'Text';
				break;
			case 'youtube':
				$scope.typeText = 'Youtube';
				break;
			case 'video_url':
				$scope.typeText = 'Video';
				break;
			default:
				// default code block
		}
		
	};

	// for ui-bootstrap typeahead, uib-typeahead checks if selected Politician is null (politicians aren't loaded yet), and gives an empty space if it is
	$scope.selectedPolitician = null;
};