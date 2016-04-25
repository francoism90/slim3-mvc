<?php
namespace App\Middleware;
use Locale;
use Slim\{Http\Request, Http\Response};
class LocaleHandler {
	public function __construct() {
		$config = include APP_PATH.'/config/locale/settings.php';

		// Get locale
		$acceptLocale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']) ?: $_COOKIE['locale'];

		// Searches for the best match to the language
		$locale = Locale::lookup($config['locales'], $acceptLocale, true, $config['default']) ?: $config['default'];

		// Set locale
		putenv("LC_ALL=$locale");
		setlocale(LC_ALL, $locale);

		// Specify the location of the translation tables
		bindtextdomain($config['domain'], $config['path']);
		bind_textdomain_codeset($config['domain'], 'UTF-8');

		// Choose domain
		textdomain($config['domain']);
	}

	public function __invoke($request, $response, $next) {
		return $next($request, $response);
  }
}
