<?php
return array(
  // Routing
  'base_path' => basename($c['request']->getUri()->getPath()),
  'curr_path' => $c['request']->getUri()->getPath(),
  'path' => explode('/', $c['request']->getUri()->getPath()),

  // Form
  'csrf_name' => Volnix\CSRF\CSRF::TOKEN_NAME,
  'csrf_value' => Volnix\CSRF\CSRF::getToken(),

  // Navbar
  'navbar' => array(
    array('title' => 'Home', 'path' => 'index')
  ),

  // Navbar => dropdown
  'navbar_dropdown' => array(
    array('title' => 'Add Item', 'path' => 'add'),
  )
);
