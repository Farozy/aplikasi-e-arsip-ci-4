<?php
$routes->group('auth', ['namespace' => '\App\Modules\Auth\Controllers'], function ($routes) {
	$routes->get('/', 'Auth::index');
	$routes->add('login', 'Auth::login');
	$routes->add('register', 'Auth::register');
	$routes->add('save', 'Auth::save');
	$routes->add('logout', 'Auth::logout');
	$routes->add('reset_password', 'Auth::reset_password');
});
