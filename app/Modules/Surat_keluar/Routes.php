<?php
$routes->group('surat_keluar', ['namespace' => '\App\Modules\Surat_keluar\Controllers'], function ($routes) {
	$routes->get('/', 'Surat_keluar::index');
	$routes->add('listData', 'Surat_keluar::listData');
	$routes->add('detail/(:num)', 'Surat_keluar::detail/$1');
	$routes->add('create', 'Surat_keluar::create');
	$routes->add('save', 'Surat_keluar::save');
	$routes->add('edit/(:num)', 'Surat_keluar::edit/$1');
	$routes->add('update', 'Surat_keluar::update');
	$routes->add('upload_save', 'Surat_keluar::upload_save');
	$routes->add('disposisi', 'Surat_keluar::disposisi');
	$routes->add('simpan_disposisi', 'Surat_keluar::simpan_disposisi');
	$routes->add('hapus', 'Surat_keluar::hapus');
});
