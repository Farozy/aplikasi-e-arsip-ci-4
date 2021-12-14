<?php namespace App\Modules\Auth\Controllers;

use App\Modules\User\Models\userModel;
use Config\Services;

class Auth extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->auth = new userModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Form Login',
			'validation' => $this->validation
		];

		return view('App\Modules\Auth\Views/login', $data);
	}

	public function login()
	{
		$input = $this->request->getVar();
		$remember = $this->request->getVar('remember');
		$data = $this->auth->where('username', $input['username'])->first();

		if( $data ) {
			if(password_verify($input['password'], $data['password']) ) {
				if( $data['is_active'] != 1 ) {
					session()->setFlashdata('error', 'akun belum aktif / dinon-aktifkan !');
					return redirect()->back();
				} else {
					if( $data['role_id'] == 1 ) {
						$data_session = [
							'email' => $data['email'],
							'username' => $data['username'],
							'password' => $data['password'],
							'role_id' => $data['role_id'],
							'foto' => $data['foto'],
							'logged_in' => true
						];

						if( $remember != null ) {
						}

						session()->set($data_session);
						set_cookie('login', 'ok', time() + 60);

						return redirect()->to('/dashboard');
					} elseif( $data['role_id'] == 3 ) {
						session()->setFlashdata('error', 'Login khusus admin');
						return redirect()->back();
					}else if( $data['role_id'] == 5 ) {
						$data_session = [
							'email' => $data['email'],
							'username' => $data['username'],
							'password' => $data['password'],
							'role_id' => $data['role_id'],
							'foto' => $data['foto'],
							'logged_in' => true
						];

						if( $remember != null ) {
						}

						session()->set($data_session);
						set_cookie('login', 'ok', time() + 60);

						return redirect()->to('/dashboard');
					}
				}
			} else {
				session()->setFlashdata('error', 'password salah !');
				return redirect()->back();
			}
		} else {
			session()->setFlashdata('error', 'username tidak terdaftar');
			return redirect()->back();
		}
	}

	public function register()
	{
		$data = [
			'title' => 'Form Register',
			'validation' => $this->validation
		];

		return view('App\Modules\Auth\Views/register', $data);
	}

	public function save()
	{
		$input = $this->request->getVar();
		$this->validation->run($input, 'user');
		$errors = $this->validation->getErrors();

		if( ! $errors ) {

			$data = [
				'nama_lengkap' => strtolower($input['nama_lengkap']),
				'email' => $input['email'],
				'username' => strtolower($input['username']),
				'password' => $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT),
				'foto' => 'default.png',
				'role_id' => 3,
				'is_active' => 0,
				'created_date' => date('Y-m-d'),
				'updated_date' => 0
			];

			unset($input['password2']);
			
			$this->auth->insert($data);
			session()->setFlashdata('success', 'Register berhasil, silahkan login');
			return redirect()->to('auth');

		} else {
			return redirect()->back()->withInput();
		}
	}

	public function logout()
	{
		$data = ['email', 'username', 'password', 'role_id', 'logged_in'];
		session()->remove($data);
		session()->setFlashdata('success', 'anda telah logout');
		return redirect()->to('/');
	}

	public function reset_password()
	{
		$data = [
			'title' => 'Reset Password',
		];

		return view('App\Modules\Auth\Views/reset_password', $data);
	}
}
