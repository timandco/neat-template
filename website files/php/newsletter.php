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

	$email = trim($_POST['e-mail']);

	$message = "You can add a new e-mail address to your newsletter list: " . $email;

	$error = '';

	$subject = 'Newsletter Subscription - Neat';

	// Check email

	if(!$email) {
		$error .= 'Please enter an e-mail address.<br />';
	}

	if($email && !ValidateEmail($email)) {
		$error .= 'Please enter a valid e-mail address.<br />';
	}

	if(!$error) {
		ini_set("sendmail_from", WEBMASTER_EMAIL); // for windows server

		$mail = mail(WEBMASTER_EMAIL, $subject, $message,
			"From: "
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