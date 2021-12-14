<?php
$routes->group('surat_masuk', ['namespace' => '\App\Modules\Surat_masuk\Controllers'], function ($routes) {
	$routes->get('/', 'Surat_masuk::index');
	$routes->add('listData', 'Surat_masuk::listData');
	$routes->add('detail/(:num)', 'Surat_masuk::detail/$1');
	$routes->add('create', 'Surat_masuk::create');
	$routes->add('save', 'Surat_masuk::save');
	$routes->add('edit/(:num)', 'Surat_masuk::edit/$1');
	$routes->add('update', 'Surat_masuk::update');
	$routes->add('hapus', 'Surat_masuk::hapus');
	$routes->add('upload_save', 'Surat_masuk::upload_save');
	$routes->add('disposisi', 'Surat_masuk::disposisi');
	$routes->add('simpan_disposisi', 'Surat_masuk::simpan_disposisi');
	$routes->add('laporan_masuk', 'Surat_masuk::laporan_masuk');
	$routes->add('get_masuk', 'Surat_masuk::get_masuk');
});
