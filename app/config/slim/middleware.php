<?php
$app->add(
  new Slim\HttpCache\Cache('public', 86400),
  new App\Middleware\SessionHandler(),
  new App\Middleware\LocaleHandler()
);
