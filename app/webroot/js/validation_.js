$(document).ready(function(){
	$('#name').blur(function(){
		$.post(
			'/cake-contact-ajax/Mails/validate_form',
			{ field: $('#name').attr('id'), value: $('#name').val() },
			handleNameValidation
		);
	});
	
	function handleNameValidation(error) {
		if (error.length > 0) {
			if ($('#name-notEmpty').length == 0) {
				$('#name').after('<div id="name-notEmpty" class="error-Mail">' + error + "</div>");
			}
		}
		else {
			$('#name-notEmpty').remove();
		}
	}
	
	$('#email').blur(function(){
		$.post(
			'/cake-contact-ajax/Mails/validate_form',
			{ field: $('#email').attr('id'), value: $('#email').val() },
			handleEmailValidation
		);
	});
	
	function handleEmailValidation(error) {
		if (error.length > 0) {
			if ($('#email-valid').length == 0) {
				$('#email').after('<div id="email-valid" class="error-Mail">' + error + "</div>");
			}
		}
		else {
			$('#email-valid').remove();
		}
	}
	
	$('#Mail').blur(function(){
		$.post(
			'/cake-contact-ajax/Mails/validate_form',
			{ field: $('#Mail').attr('id'), value: $('#Mail').val() },
			handleMailValidation
		);
	});
	
	function handleMailValidation(error) {
		if (error.length > 0) {
			if ($('#Mail-notEmpty').length == 0) {
				$('#Mail').after('<div id="Mail-notEmpty" class="error-Mail">' + error + "</div>");
			}
		}
		else {
			$('#Mail-notEmpty').remove();
		}
	}
});
