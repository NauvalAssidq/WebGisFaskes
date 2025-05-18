<?php

namespace App\Controllers;
use App\Models\MapModel;

class Main extends BaseController
{
    public function index()
    {
        return view('main/index');
    }
    
    public function map()
    {
        return view('main/map');
    }
    
    public function healthcare_list()
    {
        return view('main/daftar_faskes');
    }
}