<?php

namespace App\Models;

use CodeIgniter\Model;

class AccommodationModel extends Model
{
    protected $table            = 'accommodations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'destination_id', 'name', 'description', 'address', 'price', 
        'phone', 'website', 'latitude', 'longitude', 'rating', 'image', 'created_at'
    ];

    protected $useTimestamps = false;
}
