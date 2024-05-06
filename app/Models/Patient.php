<?php

namespace App\Models;

use CodeIgniter\Model;

class Patient extends Model
{
    protected $table            = 'patients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'norm',
        'nik',
        'name',
        'address',
        'gender',
        'birth_place',
        'birth_date',
        'age',
        'religion',
        'district',
        'village',
        'regency',
        'diagnose',
        'created_at',
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
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function generateNorm(): string
    {
        // Generate a unique ID: RM-0001
        $last = $this->select('norm')->orderBy('norm', 'DESC')->first();
        if ($last) {
            $lastId = explode('-', $last['norm']);
            $newId = $lastId[1] + 1;
            return 'RM-' . str_pad($newId, 4, '0', STR_PAD_LEFT);
        } else {
            return 'RM-0001';
        }
    }
}
