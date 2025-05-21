<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class HealthFacility extends Entity
{
    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [
        'id'            => 'int',
        'code'          => 'string',
        'name'          => 'string',
        'address'       => 'string',
        'district'      => 'string',
        'amenity'       => 'string',
        'class'         => 'string',
        'hospital_type' => 'string',
        'lat'           => 'float',
        'lng'           => 'float',
    ];
}
