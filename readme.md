# Twilio module for Kohana

This module provides a Kohana interface to the [Twilio](http://www.twilio.com) service. In order to use this module you must be registered with the Twilio service.

## Configuration
Create a twilio.php file in your application's config directory containing your Account SID, Auth Token, and from phone number (available from the dashboard of your Twilio account.

	return array(
		'default'	=>	array(
			'from'			=>	'...',
			'account_sid'	=>	'...',
			'auth_token'	=>	'...',
		)
	);

You can configure multiple Twilio instances so you can use a different phone number in different circumstances:

	return array(
		'default'	=>	array(
			'from'			=>	'112233',
			'account_sid'	=>	'...',
			'auth_token'	=>	'...',
		),
		'authentication'	=>	array(
			'from'			=>	'123456',
			'account_sid'	=>	'...',
			'auth_token'	=>	'...',
		),
		'notification'	=>	array(
			'from'			=>	'654321',
			'account_sid'	=>	'...',
			'auth_token'	=>	'...',
		)
	);

## Examples

Send an SMS:
	SMS::factory($number, $message)
		->send('notification');

Send a verification code:
	$code = SMS_Token::factory($phone_number)->code();	// Sends a verification code to the specified phone number and returns the code.

	