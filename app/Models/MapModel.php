<?php

namespace App\Models;

use CodeIgniter\Model;

class MapModel extends Model
{
    protected $table = 'health_facilities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'amenity', 'geom'];

    protected $returnType = 'array';

    public function getAllMarkers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select("id, name, amenity, ST_X(geom) AS lng, ST_Y(geom) AS lat");
        $builder->where('geom IS NOT NULL');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function searchFilteredAmenities($search = '', $amenity = '')
    {
        $builder = $this->db->table('health_facilities');
        $builder->where('geom IS NOT NULL');
        $builder->select('id, name, amenity, ST_X(geom) AS lng, ST_Y(geom) AS lat');

        if ($search) {
            $builder->like('name', $search);
        }

        if ($amenity) {
            $builder->where('amenity', $amenity);
        }

        return $builder->get()->getResultArray();
    }

    public function getAmenityTypes()
    {
        $query = $this->db->query("SELECT DISTINCT amenity FROM health_facilities WHERE amenity IS NOT NULL AND amenity != '' ORDER BY amenity ASC;");
        return array_column($query->getResultArray(), 'amenity');
    }
}
