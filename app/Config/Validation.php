<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $user = [
		'nama_lengkap' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field nama lengkap harus diisi',
			]
		],
		'email' => [
			'rules' => 'trim|required|valid_email[user.email]|is_unique[user.email]',
			'errors' => [
				'required' => 'Field email harus diisi',
				'valid_email' => 'Email yang dimasukkan tidak valid',
				'is_unique' => 'Email sudah terdaftar'
			]
		],
		'username' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field {field} harus diisi',
			]
		],
		'password' => [
			'rules' => 'trim|required|min_length[3]|matches[password2]',
			'errors' => [
				'required' => 'Field password harus diisi',
				'min_length' => 'Min. 3 karakter untuk password',
				'matches' => 'Password yang dimasukkan tidak cocok'
			]
		],
		'password2' => [
			'rules' => 'trim|required|matches[password]',
			'errors' => [
				'required' => 'Field ulangi password harus diisi',
				'matches' => 'Password yang dimasukkan tidak cocok'
			]
		]
	];

	public $user2 = [
		'nama_lengkap' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field nama lengkap harus diisi',
			]
		],
		'email' => [
			'rules' => 'trim|required|valid_email[user.email]',
			'errors' => [
				'required' => 'Field email harus diisi',
				'valid_email' => 'Email yang dimasukkan tidak valid'
			]
		],
		'username' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field {field} harus diisi',
			]
		],
		'password' => [
			'rules' => 'trim|required|min_length[3]|matches[password2]',
			'errors' => [
				'required' => 'Field password harus diisi',
				'min_length' => 'Min. 3 karakter untuk password',
				'matches' => 'Password yang dimasukkan tidak cocok'
			]
		],
		'password2' => [
			'rules' => 'trim|required|matches[password]',
			'errors' => [
				'required' => 'Field repeat password harus diisi',
				'matches' => 'Password yang dimasukkan tidak cocok'
			]
		],
		'role_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field role harus dipilih'
			]
		],
		'foto' => [
			'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
			'errors' => [
				'max_size' => 'Ukuran foto terlalu besar',
				'is_image' => 'Yang anda upload bukan {field}',
				'mime_in' => 'Yang anda upload bukan {field}'
			]
		],
		'is_active' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field Status harus dipilih'
			]
		]
	];

	public $dokumen = [
		'jenis_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field jenis dokumen belum dipilih',
			]
		],
		'nama_dokumen' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field nama dokumen belum diisi',
			]
		],
		'dokumen' => [
			'rules' => 'uploaded[dokumen]|max_size[dokumen,2024]|ext_in[dokumen,pdf]',
			'errors' => [
				'uploaded' => 'Tidak ada dokumen yang dipilih',
				'max_size' => 'Ukuran file terlalu besar',
				'ext_in' => 'File yang diupload bukan pdf'
			]
		],
		'tahun' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field tahun belum diisi',
			]
		],
		'deskripsi' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field deskirpsi belum diisi',
			]
		],
		'tanggal_upload' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field tanggal upload belum diisi',
			]
		]
	];

	public $surat_masuk = [
		'no_surat' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field nomer surat belum diisi',
			]
		],
		'tanggal' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field tanggal surat belum diisi',
			]
		],
		'sifat_surat' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field sifat surat belum dipilih',
			]
		],
		'pengirim' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field pengirim belum diisi',
			]
		],
		'perihal' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field perihal belum diisi',
			]
		],
		'isi_surat' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field isi surat belum diisi',
			]
		]
	];

	public $surat_keluar = [
		'no_surat' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field nomer surat belum diisi',
			]
		],
		'tanggal' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field tanggal surat belum diisi',
			]
		],
		'sifat_surat' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Field sifat surat belum dipilih',
			]
		],
		'pengirim' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field pengirim belum diisi',
			]
		],
		'perihal' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field perihal belum diisi',
			]
		],
		'tertuju' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field tertuju belum diisi',
			]
		],
		'alamat' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field alamat belum diisi',
			]
		],
		'isi_surat' => [
			'rules' => 'trim|required',
			'errors' => [
				'required' => 'Field isi surat belum diisi',
			]
		]
	];
}
