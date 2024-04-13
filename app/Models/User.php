<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function findByUsernameAndPassword(string $username, string $password): ?object
    {
        return $this->where('name', $username)->where('password', $password)->first();
    }
    public function findRankByUserId(int $userid): string
    {
        $user = $this->where('id', $userid)->first();
        return $user->rank;
    }
    public function findInfoByUserIds($list): array
    {
        return $this->select('id, name')->whereIn('id', $list)->findAll();
    }
    public function findByRank(string $rank): array
    {
        return $this->select('id, name')->where('rank', $rank)->findAll();
    }
}
