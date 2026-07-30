<?php

namespace App\Models;

use CodeIgniter\Model;

class DestinationUserGalleryModel extends Model
{
    protected $table            = 'destination_user_galleries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'destination_id',
        'name',
        'phone',
        'title',
        'description',
        'image_path',
        'status',
        'show_on_dashboard',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all approved user photos for a destination
     */
    public function getPhotosByDestination($destinationId)
    {
        return $this->where('destination_id', $destinationId)
                    ->where('status', 'approved')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
