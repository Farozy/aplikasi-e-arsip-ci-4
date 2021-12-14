<?php
$routes->group('unit_kerja', ['namespace' => '\App\Modules\Unit_kerja\Controllers'], function ($routes) {
	$routes->get('/', 'Unit_kerja::index');
	$routes->add('listData', 'Unit_kerja::listData');
	$routes->add('create', 'Unit_kerja::create');
	$routes->add('save', 'Unit_kerja::save');
	$routes->add('edit', 'Unit_kerja::edit');
	$routes->add('update', 'Unit_kerja::update');
	$routes->add('hapus', 'Unit_kerja::hapus');
	$routes->add('toggle', 'Unit_kerja::toggle');
});
