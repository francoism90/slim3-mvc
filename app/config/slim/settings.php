<?php
return ['settings' => [
  // App
  'determineRouteBeforeAppMiddleware' => false,
  'displayErrorDetails' => true,

  // View
  'view' => [
    'template_path' => APP_PATH.'/view',
    'twig' => [
      'cache' => false,
	  //'cache' =>  ROOT_PATH . '/tmp/cache/twig',
      'debug' => true,
      'autoreload' => true
    ]
  ],

  // Connection
  'connection' => [
    'dsn' => 'mysql:unix_socket=/run/mysqld/mysqld.sock;dbname=slimdb;charset=utf8',
    'user' => 'myuser',
    'pass' => 'mypass'
  ]
]];
