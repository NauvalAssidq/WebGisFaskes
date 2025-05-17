<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        return view('dashboard/index', [
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
        ]);
    }
}
