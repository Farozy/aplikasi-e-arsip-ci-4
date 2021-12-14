<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\Auth;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'auth'	   => Auth::class
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'auth' => [ 'except' => [
				'/',
				'auth', 'auth/*',
				// 'home', 'home/*',
				// 'honeypot',
				// 'csrf',
				]
			]
		],
		'after'  => [
			'auth' => [ 'except' => [
				'/',
				'auth', 'auth/*',
				'dashboard', 'dashboard/*',
				'jenis', 'jenis/*',
				'user', 'user/*',
				'dokumen', 'dokumen/*',
				'laporan', 'laporan/*',
				'unit_kerja', 'unit_kerja/*',
				'surat_masuk', 'surat_masuk/*',
				'surat_keluar', 'surat_keluar/*',
				// 'toolbar',
				// 'honeypot',
				]
			]
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
