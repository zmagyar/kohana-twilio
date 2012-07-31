<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Sends a verification code via SMS.
 *
 * @author Rob Taylor
 */
class Twilio_SMS_Token
{
	/**
	 * @var	integer	The verification code sent in the SMS
	 */
	protected $_code;

	/**
	 * @var	string	Contents of the SMS message to notify a user of their verification code.
	 */
	public static $message = "Your verification code is :code";

	public function __construct()
	{
		$this->_code = mt_rand(100000, 999999);
	}

	/**
	 * Returns the verification code.
	 *
	 * @return 	integer
	 */
	public function code()
	{
		return $this->_code;
	}

	public static function factory($number)
	{
		$token = new Twilio_SMS_Token();

		if ($number !== NULL)
		{
			$this->send($number);
		}

		return $token;
	}

	/**
	 * Send the verification code to the specified number.
	 *
	 * @param	string	$number	Phone number to send the code to.
	 * @param	string	$instance	Name of the Twilio instance to send through.
	 * @return 	SMS_Token
	 */
	public function send($number, $instance = NULL)
	{
		// Get the verification code message.
		$message = __(SMS_Token::$message, array(':code' => $this->_code));

		// Send an SMS with the verification code.
		SMS::factory($number, $message)->send($instance);

		return $this;
	}

	/**
	 * Determines whether a verification code is valid for the current token.
	 *
	 * @param	integer	$code
	 * @return 	boolean
	 */
	public function valid($code)
	{
		return $this->_code === $code;
	}

}
