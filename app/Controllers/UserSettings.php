<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserSettings extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $userId = $session->get('user_id');
        $user = $this->userModel->find($userId);
        
        $profilePath = FCPATH . 'assets/profile/';
        
        $profileImages = ['default.png'];
        if (is_dir($profilePath)) {
            $profileImages = array_diff(scandir($profilePath), ['.', '..']);
        }

        return view('dashboard/settings', [
            'username'      => $session->get('username'),
            'email'         => $session->get('email'),
            'profileImages' => $profileImages,
            'user'          => $user,
        ]);
    }

    public function update()
    {   
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $userId = $session->get('user_id');
        $user = $this->userModel->find($userId);
        $data = [];

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');
        $currentPassword = $this->request->getPost('current_password');
        $image = $this->request->getPost('image');

        if ($email && $email !== $user->email) {
            $emailCheck = $this->userModel->where('email', $email)->first();
            if ($emailCheck && $emailCheck->id != $userId) {
                return redirect()->back()->with('error', 'Email sudah digunakan oleh pengguna lain.');
            }
            $data['email'] = $email;
        }

        if ($username && $username !== $user->username) {
            $usernameCheck = $this->userModel->where('username', $username)->first();
            if ($usernameCheck && $usernameCheck->id != $userId) {
                return redirect()->back()->with('error', 'Nama pengguna sudah digunakan oleh pengguna lain.');
            }
            $data['username'] = $username;
        }

        if ($password) {
            if (!$currentPassword || !password_verify($currentPassword, $user->password)) {
                return redirect()->back()->with('error', 'Password saat ini tidak valid.');
            }
            
            if ($password !== $passwordConfirm) {
                return redirect()->back()->with('error', 'Password baru dan konfirmasi password tidak cocok.');
            }
            
            if (strlen($password) < 6) {
                return redirect()->back()->with('error', 'Password harus minimal 6 karakter.');
            }
            
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($image) {
            $imagePath = FCPATH . 'assets/profile/' . $image;
            if (file_exists($imagePath)) {
                $data['image'] = $image;
                $session->set('image', $image);
            }
        }

        if (!empty($data)) {
            $this->userModel->update($userId, $data);
            
            if (isset($data['username'])) {
                $session->set('username', $data['username']);
            }
            
            if (isset($data['email'])) {
                $session->set('email', $data['email']);
            }
            
            return redirect()->back()->with('message', 'Pengaturan berhasil disimpan.');
        }
        
        return redirect()->back()->with('error', 'Tidak ada perubahan yang disimpan.');
    }
}