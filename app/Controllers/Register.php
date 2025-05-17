<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function create()
    {
        helper(['form']);
        $session = session();

        $validation = \Config\Services::validation();

        $rules = [
            'name'     => 'required|min_length[3]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $model = new UserModel();
        $model->save([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'verified' => 1
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
    }
}
