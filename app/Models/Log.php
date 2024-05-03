<?php

namespace App\Models;

use CodeIgniter\Model;

class Log extends Model
{
    protected $table            = 'logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_id',
        'activity',
        'description',
        'created_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'admin_id' => 'required|integer',
        'activity' => 'required|string',
        'description' => 'required|string',
        'created_at' => 'required|valid_date'
    ];
    protected $validationMessages   = [
        'admin_id' => [
            'required' => 'Admin ID wajib diisi',
            'integer' => 'Admin ID harus berupa angka'
        ],
        'activity' => [
            'required' => 'Aktivitas wajib diisi',
            'string' => 'Aktivitas harus berupa huruf'
        ],
        'description' => [
            'required' => 'Deskripsi wajib diisi',
            'string' => 'Deskripsi harus berupa huruf'
        ],
        'created_at' => [
            'required' => 'Tanggal dibuat wajib diisi',
            'valid_date' => 'Tanggal dibuat harus berupa tanggal yang valid'
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
