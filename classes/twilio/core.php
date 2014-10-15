<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Twilio API wrapper for Kohana
 *
 * @author Rob Taylor
 */
class Twilio_Core
{
	/**
	 * @var	Services_Twilio	The Twilio API client.
	 */
	protected $_client;
	/**
	 * @var	array 	Config options for current instance
	 */
	protected $_config = array();

	/**
	 * @var  string  Default instance name
	 */
	public static $default = 'default';

	/**
	 * @var	array 	Twilio instances
	 */
	public static $instances = array();

	protected function __construct(array $config = NULL)
	{
		$this->_config = $config;

		// Load the Twilio API
		if ( ! class_exists('Services_Twilio'))
		{
			require Kohana::find_file('vendor', 'twilio/Services/Twilio');
		}

		// Instantiate an instance of the Twilio API.
		$this->_client = new Services_Twilio(Arr::get($config, 'account_sid'), Arr::get($config, 'auth_token'));
	}

	public static function instance($name = NULL, array $config = NULL)
	{
		if ($name === NULL)
		{
			$name = Twilio::$default;
		}

		if ( ! isset(Twilio::$instances[$name]))
		{
			if ($config === NULL)
			{
				$config = Kohana::$config->load('twilio')->$name;
			}

			// Check for a Twilio account SID and Auth Token in the config.
			if ( ! isset($config['account_sid']))
			{
				throw new Kohana_Exception("Account SID not defined in :name config", array(':name' => $name));
			}

			if ( ! isset($config['auth_token']))
			{
				throw new Kohana_Exception("Auth token not defined in :name config", array(':name' => $name));
			}

			Twilio::$instances[$name] = new Twilio($config);
		}

		return Twilio::$instances[$name];
	}

	public function send_sms($number, $message)
	{
		$this->_client->account->messages->sendMessage(Arr::get($this->_config, 'from'), $number, $message);
	}

}
