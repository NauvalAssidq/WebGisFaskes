<?php

namespace App\Controllers;
use App\Models\MapModel;

class Map extends BaseController
{
    public function index()
    {
        return view('main/map_view');
    }

    public function getMarkers()
{
        $search = $this->request->getGet('search');
        $amenities = $this->request->getGet('amenities');

        $model = new MapModel();
        $markers = $model->searchFilteredAmenities($search, $amenities);

        return $this->response->setJSON($markers);
    }

    public function getAmenitiesList()
    {
        $model = new MapModel();
        $data = $model->getAmenityTypes();

        return $this->response->setJSON($data);
    }
}