<?php
$routes->group('jenis', ['namespace' => '\App\Modules\Jenis\Controllers'], function ($routes) {
	$routes->get('/', 'Jenis::index');
	$routes->add('listData', 'Jenis::listData');
	$routes->add('create', 'Jenis::create');
	$routes->add('save', 'Jenis::save');
	$routes->add('edit', 'Jenis::edit');
	$routes->add('update', 'Jenis::update');
	$routes->add('hapus', 'Jenis::hapus');
	$routes->add('toggle', 'Jenis::toggle');
});
