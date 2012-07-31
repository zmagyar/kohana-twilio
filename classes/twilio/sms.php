<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class to send SMS using the Twilio service API.
 *
 * @author Rob Taylor
 */
class Twilio_SMS
{
	/**
	 * @var	array 	Phone numbers to send the message to.
	 */
	protected $_numbers = array();

	/**
	 * @var	string	Message to be sent.
	 */
	protected $_message;

	public function __construct($number, $message)
	{
		if ($number)
		{
			$this->numbers(array($number));
		}

		if ($message)
		{
			$this->message($message);
		}
	}

	/**
	 * Creates a new SMS object.
	 *
	 * @param	string	$number	Phone number to send the message to.
	 * @param 	string	$message	Message to be sent in the SMS
	 * @return SMS
	 */
	public static function factory($number = NULL, $message = NULL)
	{
		return new SMS($recipient, $message);
	}

	/**
	 * Gets or sets the message to be included in the SMS.
	 *
	 * @param	string 	$message	Message content
	 * @return 	string 
	 */
	public function message($message = NULL, array $params = NULL)
	{
		if ($message === NULL)
		{
			// Act as getter.
			return $this->_message;
		}
		else
		{
			if ($params !== NULL)
			{
				foreach ($params as $name => $value)
				{
					$message = str_replace($name, $value, $message);
				}
			}

			// Act as setter.
			$this->_message = $message;

			return $this;
		}
	}

	/**
	 * Gets or sets the phone numbers to send the SMS to.
	 *
	 * @param	array 	$numbers	Array of phone numbers
	 * @return 	array 
	 */
	public function numbers(array $numbers = NULL)
	{
		if ($numbers == NULL)
		{
			// Act as getter.
			return $this->_numbers;
		}
		else
		{
			// Act as setter.
			$this->_numbers = $numbers;

			return $this;
		}
	}

	public function send($name = NULL)
	{
		$twilio = Twilio::instance($name);

		foreach ($this->_numbers as $number)
		{
			$twilio->send_sms($number, $message);
		}
	}

}
