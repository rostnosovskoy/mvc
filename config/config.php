<?php

Config::set('site_name', "Your site name");
Config::set('language', array('en', 'ru'));

// Routes. Route name => method prefix
Config::set('routes', [
    'default' => '',
    'admin' => 'admin',
]);

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');