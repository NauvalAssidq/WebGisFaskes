<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\HealthFacility;

class MapModel extends Model
{
    protected $table = 'faskes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code', 'name', 'address', 'district', 'amenity', 'class', 'hospital_type', 'lat', 'lng', 'care_type', 'image'
    ];
    protected $returnType = HealthFacility::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function getAllMarkers()
    {
        return $this->select(['id', 'name', 'amenity', 'lat', 'lng'])
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->get()
            ->getResultArray();
    }

    public function searchFilteredAmenities(string $search = '', array $amenities = []): array
    {
        $builder = $this->builder()
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ]);

        if ($search !== '') {
            $builder->like('name', $search);
        }

        if (!empty($amenities)) {
            $builder->whereIn('amenity', $amenities);
        }

        return $builder->get()->getResult();
    }

    public function getAmenityTypes(): array
    {
        return $this->builder()
            ->distinct()
            ->select('amenity')
            ->where('amenity IS NOT NULL')
            ->where('amenity !=', '')
            ->orderBy('amenity', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getTopAmenityCounts(int $limit = 3): array
    {
        return $this->builder()
            ->select('amenity')
            ->select('COUNT(*) AS total', false)
            ->where('amenity IS NOT NULL')
            ->where('amenity !=', '')
            ->groupBy('amenity')
            ->orderBy('total', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getFacilitiesGroupedByAmenity(): array
    {
        $rows = $this->builder()
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ])
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->where('amenity IS NOT NULL')
            ->where('amenity !=', '')
            ->orderBy('amenity', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['amenity']][] = $row;
        }

        return $grouped;
    }

    public function getFacilitiesWithCoordinatesByAmenity(string $amenity): array
    {
        return $this->builder()
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ])
            ->where('amenity', $amenity)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult(HealthFacility::class);
    }

    public function updateFacility(int $id, array $data, ?float $lat = null, ?float $lng = null): bool
    {
        $db = $this->db;
        $builder = $this->builder();

        $db->transStart();

        if ($lat !== null && $lng !== null) {
            $data['lat'] = $lat;
            $data['lng'] = $lng;
        }

        $builder->where($this->primaryKey, $id)
                ->update($data);

        $db->transComplete();

        return $db->transStatus();
    }

    public function getFacilityWithCoordinates(int $id): ?HealthFacility
    {
        return $this->builder()
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getFirstRow(HealthFacility::class);
    }

    public function saveWithLatLng(HealthFacility $facility)
    {
        if (!$facility->id) {
            log_message('error', 'Facility ID missing');
            return false;
        }

        if (!$facility->hasChanged()) {
            log_message('debug', 'No changes detected in facility entity');
            return true;
        }

        return $this->save($facility);
    }

    public function getByDistrict(string $district): array
    {
        return $this->builder()
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ])
            ->where('district', $district)
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult(HealthFacility::class);
    }

    public function getByHospitalType(string $type): array
    {
        return $this->builder()
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ])
            ->where('hospital_type', $type)
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult(HealthFacility::class);
    }

    public function getByClass(string $class): array
    {
        return $this->builder()
            ->select([
                'id', 'code', 'name', 'address', 'district', 'amenity',
                'class', 'hospital_type', 'care_type', 'image', 'lat', 'lng'
            ])
            ->where('class', $class)
            ->where('lat IS NOT NULL')
            ->where('lng IS NOT NULL')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResult(HealthFacility::class);
    }
}
