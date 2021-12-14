<?php
$routes->group('user', ['namespace' => '\App\Modules\User\Controllers'], function ($routes) {
	$routes->get('/', 'User::index');
	$routes->add('listData', 'User::listData');
	$routes->add('create', 'User::create');
	$routes->add('save', 'User::save');
	$routes->add('edit/(:num)', 'User::edit/$1');
	$routes->add('update', 'User::update');
	$routes->add('detail', 'User::detail');
	$routes->add('hapus', 'User::hapus');
	$routes->add('toggle', 'User::toggle');
	$routes->add('UbahPassword', 'User::UbahPassword');
	$routes->add('simpanUbahPassword', 'User::simpanUbahPassword');
});
