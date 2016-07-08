<?php
/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

require 'config.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post) {
	
	include 'functions.php';

	$name = stripslashes($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$message = stripslashes($_POST['message']);

	if ( ! empty( $phone ) ) {
		$message .= "\r\n\r\nPhone: {$phone}";
	}

	$error = '';

	$subject = 'Contact Form Submission - Neat';

	// Check name

	if (!$name) {
		$error .= 'Please enter your name.<br />';
	}

	// Check email

	if(!$email) {
		$error .= 'Please enter an e-mail address.<br />';
	}

	if($email && !ValidateEmail($email)) {
		$error .= 'Please enter a valid e-mail address.<br />';
	}

	// Check message (length)

	if(!$message) {
		$error .= 'You don\'t have anything to say?<br />';
	}


	if(!$error) {
		ini_set("sendmail_from", WEBMASTER_EMAIL); // for windows server

		$mail = mail(WEBMASTER_EMAIL, $subject, $message,
			"From: " . $name 
			. "<" . $email . ">\r\n"
			. "Reply-To: " . $email . "\r\n"
			. "X-Mailer: PHP/" . phpversion()
    	);

		if($mail) {
			echo 'OK';
		} else {
			echo 'broken';
		}
	}	

	else {
		echo '<div class="form-feedback form-error">'.$error.'</div>';
	}
}

die();
?>