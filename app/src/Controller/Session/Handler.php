<?php
namespace App\Controller\Session;
class Handler {
	public static function set(array $session) {
		foreach ($session as $key => $params) {
			if (empty($_SESSION[$key]) || $params['overrule'])
				$_SESSION[$key] = $params['value'];
		}
	}

	public static function destroy(string $key) {
		unset($_SESSION[$key]);
	}

	public static function destroyCookie(string $key) {
		$params = session_get_cookie_params();
		setcookie($key, '', 1, $params['path'], $params['domain'],
			$params['secure'], $params['httponly']);
	}
}
