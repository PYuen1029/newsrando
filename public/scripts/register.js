'use strict';

$("#register-form").validate({
	rules: {
		username: {
			required: true,
			minlength: 3
		},
		password: {
			required: true,
			minlength: 8
		},
		password_repeat: {
			required: true,
			equalTo: '#password'
		},
		email: {
			required: true,
			email: true
		}
	},
	errorElement : 'div',
	errorPlacement: function(error, element) {
		var placement = $(element).data('error');
		if (placement) {
			$(placement).append(error);
		} else {
			error.insertAfter(element);
		}
	}

});