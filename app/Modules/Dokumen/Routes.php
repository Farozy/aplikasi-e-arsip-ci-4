<?php
$routes->group('dokumen', ['namespace' => '\App\Modules\Dokumen\Controllers'], function ($routes) {
	$routes->get('/', 'Dokumen::index');
	$routes->add('listData', 'Dokumen::listData');
	$routes->add('detail', 'Dokumen::detail');
	$routes->add('create', 'Dokumen::create');
	$routes->add('save', 'Dokumen::save');
	$routes->add('edit/(:num)', 'Dokumen::edit/$1');
	$routes->add('update', 'Dokumen::update');
	$routes->add('upload', 'Dokumen::upload');
	$routes->add('upload_save', 'Dokumen::upload_save');
	$routes->add('download', 'Dokumen::download');
	$routes->add('hapus', 'Dokumen::hapus');
});
