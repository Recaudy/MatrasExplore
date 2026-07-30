<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'destination_id',
        'name',
        'phone',
        'rating',
        'comment',
        'status',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all approved reviews for a destination
     */
    public function getReviewsByDestination($destinationId)
    {
        return $this->where('destination_id', $destinationId)
                    ->where('status', 'approved')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Calculate statistical summary of reviews for a destination
     */
    public function getDestinationRatingStats($destinationId)
    {
        $reviews = $this->where('destination_id', $destinationId)
                        ->where('status', 'approved')
                        ->findAll();

        $total = count($reviews);
        if ($total === 0) {
            return [
                'avg_rating' => 0,
                'total_reviews' => 0,
                'breakdown' => [
                    5 => 0,
                    4 => 0,
                    3 => 0,
                    2 => 0,
                    1 => 0
                ]
            ];
        }

        $sum = 0;
        $breakdown = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];

        foreach ($reviews as $row) {
            $r = (int)$row['rating'];
            if ($r >= 1 && $r <= 5) {
                $breakdown[$r]++;
                $sum += $r;
            }
        }

        $avg = round($sum / $total, 1);

        return [
            'avg_rating' => $avg,
            'total_reviews' => $total,
            'breakdown' => $breakdown
        ];
    }
}
