<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function is_logged_in($login_required=true) {
		
		$user_id = null;

		$user = $this->session->userdata('user_data');
		if (!isset($user)) { 
			return false; 
		} else { 
			return true;
		}

		return $user_id;
	}

	if ( ! function_exists('rest_log_message'))
	{
		/**
		 * Error Logging Interface
		 *
		 * We use this as a simple mechanism to access the logging
		 * class and send messages to be logged.
		 *
		 * @param	string	the error level: 'error', 'debug' or 'info'
		 * @param	string	the error message
		 * @return	void
		 */
		function rest_log_message($level, $message, $php_error, $file_name)
		{
			static $_log;

			if ($_log === NULL)
			{
				// references cannot be directly assigned to static variables, so we use an array
				$_log[0] =& load_class('Log', 'core');
			}

			$_log[0]->write_log($level, $message, $php_error, $file_name);
		}
	}
?>