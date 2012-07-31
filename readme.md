# Twilio module for Kohana

This module provides a Kohana interface to the [Twilio](http://www.twilio.com) service. In order to use this module you must be registered with the Twilio service.

** This module is still in development and hasn't been tested.**

## Configuration
Create a twilio.php file in your application's config directory containing your Account SID, Auth Token, and from phone number (available from the dashboard of your Twilio account.

	return array(
		'default'	=>	array(
			'from'			=>	'...',
			'account_sid'	=>	'...',
			'auth_token'	=>	'...',
		)
	);