<?php

namespace App\Models;

use CodeIgniter\Model;

class DestinationModel extends Model
{
    protected $table            = 'destinations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'slug', 'description', 'history', 'location', 
        'latitude', 'longitude', 'opening_hours', 'ticket_price', 'status', 'created_at'
    ];

    protected $useTimestamps = false;

    /**
     * Get facilities associated with a destination
     */
    public function getFacilities(int $destinationId): array
    {
        return $this->db->table('destination_facilities')
            ->select('facilities.*')
            ->join('facilities', 'facilities.id = destination_facilities.facility_id')
            ->where('destination_facilities.destination_id', $destinationId)
            ->get()
            ->getResultArray();
    }

    /**
     * Get images associated with a destination
     */
    public function getImages(int $destinationId): array
    {
        return $this->db->table('destination_images')
            ->where('destination_id', $destinationId)
            ->get()
            ->getResultArray();
    }

    /**
     * Get accommodations associated with a destination
     */
    public function getAccommodations(int $destinationId): array
    {
        return $this->db->table('accommodations')
            ->where('destination_id', $destinationId)
            ->get()
            ->getResultArray();
    }
}
