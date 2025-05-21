<?php

namespace App\Controllers;
use App\Models\MapModel;

class MapDashboard extends BaseController
{
    protected $healthFacilityModel;
    
    public function __construct()
    {
        $this->healthFacilityModel = new MapModel();
    }
    
    public function index()
    {
        return view('dashboard/layout/map_view');
    }

    public function getMarkers()
    {
        $search    = $this->request->getGet('search');
        $amenities = $this->request->getGet('amenity');
        $districts = $this->request->getGet('district');
        $types     = $this->request->getGet('hospital_type');
        $classes   = $this->request->getGet('hospital_class');

        $amenities = is_array($amenities) ? $amenities : ($amenities ? [$amenities] : []);
        $districts = is_array($districts) ? $districts : ($districts ? [$districts] : []);
        $types     = is_array($types)     ? $types     : ($types     ? [$types]     : []);
        $classes   = is_array($classes)   ? $classes   : ($classes   ? [$classes]   : []);

        $builder = $this->healthFacilityModel->builder()
            ->select(['id', 'code', 'name', 'address', 'district', 'amenity', 'class', 'hospital_type', 'lat', 'lng'])
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL');

        if ($search) {
            $builder->like('name', $search);
        }

        if (!empty($amenities)) {
            $builder->whereIn('amenity', $amenities);
        }

        if (!empty($districts)) {
            $builder->whereIn('district', $districts);
        }

        if (!empty($types)) {
            $builder->whereIn('hospital_type', $types);
        }

        if (!empty($classes)) {
            $builder->whereIn('class', $classes);
        }

        $data = $builder->orderBy('name')->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    public function getAmenitiesList()
    {
        if (method_exists($this->healthFacilityModel, 'getAmenityTypes')) {
            $data = $this->healthFacilityModel->getAmenityTypes();
        } else {
            $data = $this->healthFacilityModel->builder()
                ->select('amenity')
                ->distinct()
                ->where('amenity IS NOT NULL')
                ->where('amenity !=', '')
                ->orderBy('amenity')
                ->get()
                ->getResultArray();
        }

        return $this->response->setJSON($data);
    }
    
    public function getDistricts()
    {
        $data = $this->healthFacilityModel->builder()
            ->select('district')
            ->distinct()
            ->where('district IS NOT NULL')
            ->where('district !=', '')
            ->orderBy('district')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }

    public function getHospitalTypes()
    {
        $data = $this->healthFacilityModel->builder()
            ->select('hospital_type')
            ->distinct()
            ->where('hospital_type IS NOT NULL')
            ->where('hospital_type !=', '')
            ->orderBy('hospital_type')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }

    public function getClasses()
    {
        $data = $this->healthFacilityModel->builder()
            ->select('class')
            ->distinct()
            ->where('class IS NOT NULL')
            ->where('class !=', '')
            ->orderBy('class')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }
}
