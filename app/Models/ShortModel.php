<?php

namespace App\Models;

use CodeIgniter\Model;

class ShortModel extends Model
{
    protected $table            = 'shorts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'youtube_url', 'description'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title'       => 'required|max_length[255]',
        'youtube_url' => 'required|valid_url',
    ];
    protected $validationMessages   = [
        'title' => [
            'required'   => 'Judul video wajib diisi.',
            'max_length' => 'Judul video maksimal 255 karakter.'
        ],
        'youtube_url' => [
            'required'  => 'URL YouTube wajib diisi.',
            'valid_url' => 'URL YouTube tidak valid.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
