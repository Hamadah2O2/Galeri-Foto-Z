<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel =  new UsersModel();
        if (session()->get('isLogin')) {
            response()->redirect(base_url());
        }
    }

    public function index()
    {
        return redirect()->to('auth/login');
    }

    public function login()
    {
        $submit = $this->request->getVar('submit');

        if ($submit) {
            $d = $this->request->getVar();

            $user = $this->UserModel->where([
                'username' => $d['username'],
            ])->first();

            if ($user && password_verify($d['password'], $user['password'])) {
                d($user);
                $ds = [
                    'username' => $d['username'],
                    'user_id' => $user['id'],
                    'isLogin' => true
                ];
                session()->set($ds);
                return redirect()->to('/');
            } else {
                session()->setFlashdata('error', 'Username atau Password salah');
                return redirect()->to('auth/login')->withInput();
            }
        }
        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $submit = $this->request->getVar('submit');

        if ($submit) {
            $d = $this->request->getVar();
            $user = $this->UserModel->where(['username' => $d['username']])->orWhere(['email' => $d['email']])->first();

            if ($user) {
                session()->setFlashdata('error', 'Email / Username sudah ada');
                return redirect()->to('auth/register')->withInput();
            }

            if ($d['password'] != $d['cpassword']) {
                session()->setFlashdata('error', 'Password Tidak Sama');
                return redirect()->to('auth/register')->withInput();
            }

            $d['password'] = password_hash($d['password'], PASSWORD_DEFAULT);
            $this->UserModel->insert($d);
            session()->setFlashdata('success', 'Berhasil  Registrasi');
            return redirect()->to('auth/login');
        }

        $data = [
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
