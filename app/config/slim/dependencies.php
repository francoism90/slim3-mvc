<?php
// Slim-HttpCache
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

// Slim-PDO
$c['pdo'] = function ($c) {
  $ref = new \ReflectionClass('Slim\PDO\Database');
  return $ref->newInstanceArgs($c['settings']['connection']);
};

// Slim-Twig
$c['view'] = function ($c) {
  $view = new Slim\Views\Twig($c['settings']['view']['template_path'], $c['settings']['view']['twig']);
  $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
  $view->addExtension(new Twig_Extensions_Extension_I18n());

  // Add globals
  $twig = $view->getEnvironment();
  $twig->addGlobal('gl', include APP_PATH.'/config/slim/globals.php'); // call: gl.key

  return $view;
};
