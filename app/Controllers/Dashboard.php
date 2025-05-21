<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MapModel;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login dulu.');
        }

        $model = new MapModel();
        $topAmenities = $model->getTopAmenityCounts(3);

        return view('dashboard/index', [
            'amenityCounts' => $topAmenities,
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
            'groupedFacilities' => $model->getFacilitiesGroupedByAmenity()
        ]);
    }

    public function map()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login dulu.');
        }

        return view('dashboard/map', [
            'username' => $session->get('username'),
            'email'    => $session->get('email'),
        ]);
    }
}
