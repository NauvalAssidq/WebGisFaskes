<?php

namespace App\Controllers;

use App\Models\MapModel;

class Main extends BaseController
{
    public function index()
    {
        $session = session();

        return view('main/index', [
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
            'image'    => $session->get('image'),
            'logged_in'=> $session->get('logged_in'),
        ]);
    }

    public function map()
    {
        $session = session();

        return view('main/map', [
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
            'image'    => $session->get('image'),
            'logged_in'=> $session->get('logged_in'),
        ]);
    }

    public function healthcare_list()
    {
        $session = session();

        return view('main/daftar_faskes', [
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
            'image'    => $session->get('image'),
            'logged_in'=> $session->get('logged_in'),
        ]);
    }
}
