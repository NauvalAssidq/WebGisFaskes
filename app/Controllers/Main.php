<?php

namespace App\Controllers;
use App\Models\MapModel;

class Main extends BaseController
{
    public function index()
    {
        return view('main/index');
    }
    
    public function peta()
    {
        return view('main/map');
    }
    
    public function daftarFaskes()
    {
        return view('main/daftar_faskes');
    }
}