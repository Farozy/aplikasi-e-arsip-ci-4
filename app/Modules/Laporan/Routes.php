<?php
$routes->group('laporan', ['namespace' => '\App\Modules\Laporan\Controllers'], function ($routes) {
	$routes->get('/', 'Laporan::index');
	$routes->add('listData', 'Laporan::listData');
	$routes->add('laporan_masuk', 'Laporan::laporan_masuk');
	$routes->add('get_masuk', 'Laporan::get_masuk');
	$routes->add('export_masuk', 'Laporan::export_masuk');
	$routes->add('laporan_keluar', 'Laporan::laporan_keluar');
	$routes->add('get_keluar', 'Laporan::get_keluar');
	$routes->add('export_keluar', 'Laporan::export_keluar');
});
