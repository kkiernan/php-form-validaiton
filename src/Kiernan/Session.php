<?php namespace Kiernan;

class Session {

	/**
	 * The singletone session instance.
	 * 
	 * @var Session
	 */
	private static $instance;

	/**
	 * Return the singleton instance of the session class.
	 * 
	 * @return Session
	 */
	public static function create()
	{
		if ( ! isset(self::$instance))
		{
			self::$instance = new static();
		}

		return self::$instance;
	}

	/**
	 * Create a new session instance. Ensures that a session is available.
	 */
	private function __construct()
	{
		if ( ! session_id())
		{
			session_start();
		}
	}

	/**
	 * Flash some data to the session.
	 * 
	 * @param  string $key
	 * @param  mixed  $value
	 * @return void
	 */
	public static function flash($key, $value)
	{
		$_SESSION['kiernan_session'][$key] = $value;
	}

	/**
	 * Retrieve old data from the session.
	 * 
	 * @param  string $key
	 * @return mixed
	 */
	public static function old($key = null)
	{
		// Return all old data.
		if (isset($_SESSION['kiernan_session']['old']) && $key === null)
		{
			return $_SESSION['kiernan_session']['old'];
		}

		// Return only the specific key if it exists in the old data.
		if (isset($_SESSION['kiernan_session']['old']) && array_key_exists($key, $_SESSION['kiernan_session']['old']))
		{
			return $_SESSION['kiernan_session']['old'][$key];
		}

		return null;
	}

	/**
	 * Check that the session has a specific key.
	 * 
	 * @param  string  $key
	 * @return boolean
	 */
	public static function has($key)
	{
		return array_key_exists($key, $_SESSION['kiernan_session']);
	}

	/**
	 * Retrieve a value from the session.
	 * 
	 * @param  string $key
	 * @return mixed
	 */
	public static function get($key)
	{
		return $_SESSION['kiernan_session'][$key];
	}

	/**
	 * Clear all kiernan_session data.
	 * 
	 * @return void
	 */
	public static function clear()
	{
		$_SESSION['kiernan_session'] = [];
	}

}