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

    public function searchFilteredAmenities($search = '', $amenities = [])
    {
        $builder = $this->db->table('health_facilities');
        $builder->where('geom IS NOT NULL');
        $builder->select('id, name, amenity, ST_X(geom) AS lng, ST_Y(geom) AS lat');

        if ($search) {
            $builder->like('name', $search);
        }

        if (!empty($amenities) && is_array($amenities)) {
            $builder->whereIn('amenity', $amenities);
        }

        return $builder->get()->getResultArray();
    }

    public function getAmenityTypes()
    {
        $query = $this->db->query("SELECT DISTINCT amenity FROM health_facilities WHERE amenity IS NOT NULL AND amenity != '' ORDER BY amenity ASC;");
        return array_column($query->getResultArray(), 'amenity');
    }

    public function getTopAmenityCounts($limit = 3)
    {
        $query = $this->db->query("
            SELECT amenity, COUNT(*) AS total 
            FROM health_facilities 
            WHERE amenity IS NOT NULL AND amenity != '' 
            GROUP BY amenity 
            ORDER BY total DESC 
            LIMIT $limit
        ");
        return $query->getResultArray();
    }

    public function getFacilitiesGroupedByAmenity()
    {
        $builder = $this->db->table('health_facilities');
        $builder->select('id, name, amenity, ST_X(geom) AS lng, ST_Y(geom) AS lat');
        $builder->where('geom IS NOT NULL');
        $builder->where('amenity IS NOT NULL');
        $builder->where('amenity != ""');
        $builder->orderBy('amenity ASC, name ASC');
        
        $results = $builder->get()->getResultArray();

        $grouped = [];

        foreach ($results as $row) {
            $grouped[$row['amenity']][] = $row;
        }

        return $grouped;
    }

}