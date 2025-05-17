<?php

namespace App\Controllers;
use App\Models\MapModel;

class Map extends BaseController
{
    public function index()
    {
        return view('main/peta');
    }

    public function getMarkers()
    {
        $search = $this->request->getGet('search');
        $amenity = $this->request->getGet('amenity');

        $model = new MapModel();
        $markers = $model->searchFilteredAmenities($search, $amenity);

        return $this->response->setJSON($markers);
    }

    public function getAmenitiesList()
    {
        $model = new MapModel();
        $data = $model->getAmenityTypes();

        return $this->response->setJSON($data);
    }
}