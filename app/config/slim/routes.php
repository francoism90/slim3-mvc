<?php
$app->get('/', function ($request, $response, $args) {
	echo print_r($_SESSION);

});

// Profile
$app->any('/profile[/{base:[a-z]+}[/{sub:[a-z0-9]+}[/{ext:[a-z0-9]+}]]]', 'App\Controller\User\Profile')->setName('profile');
