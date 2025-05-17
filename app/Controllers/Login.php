<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Email not registered.');
        }

        if (password_verify($password, $user['password'])) {
            if ($user['verified']) {
                $session->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'email'     => $user['email'],
                    'logged_in' => true,
                ]);
                return redirect()->to('dashboard');
            } else {
                return redirect()->to('/login')->with('error', 'Account not verified.');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Incorrect password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
