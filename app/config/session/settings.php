<?php
return array(
	// SessionHandler
	'savehandler' => 'redis',
  'savepath' => '/var/run/redis/redis.sock?persistent=1&weight=1&database=1',
	'maxlifetime' => 15778463, // how long an unused PHP session will be kept alive

	// Cookie
  'lifetime' => 2629743,
	'path' => '/',
	'domain' => null,
	'secure' => false,
	'httponly' => true,

	// Set $_SESSION
	'populate' => array(
		'start' => array('value' => time()),
		'hit' => array('overrule' => true, 'value' => time())
	)
);
