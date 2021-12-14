<?php
$routes->group('dashboard', ['namespace' => '\App\Modules\Dashboard\Controllers'], function ($routes) {
	$routes->get('/', 'Dashboard::index');
	$routes->add('idSekolah', 'Dashboard::idSekolah');
	$routes->add('fetch_event', 'Dashboard::fetch_event');
	$routes->add('add_event', 'Dashboard::add_event');
	$routes->add('edit_event', 'Dashboard::edit_event');
	$routes->add('delete_event', 'Dashboard::delete_event');
	$routes->add('ubah_password', 'Dashboard::ubah_password');
	$routes->add('simpan_password', 'Dashboard::simpan_password');
	$routes->add('profile_user', 'Dashboard::profile_user');
});
