<?php
namespace App\Middleware;
use Slim\{Http\Request, Http\Response};
class SessionHandler {
	public function __construct() {
		$config = include APP_PATH.'/config/session/settings.php';
		ini_set('session.save_handler', $config['savehandler']);
		ini_set('session.gc_maxlifetime', $config['maxlifetime']);
		session_save_path($config['savepath']);
		session_set_cookie_params(
		  $config['lifetime'], $config['path'], $config['domain'],
			$config['secure'], $config['httponly']
		);
		session_start();

		// Populate $_SESSION
		\App\Controller\Session\Handler::set($config['populate']);
	}

	public function __invoke($request, $response, $next) {
		return $next($request, $response);
  }
}
