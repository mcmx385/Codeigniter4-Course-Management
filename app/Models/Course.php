<?php

namespace App\Models;

use CodeIgniter\Model;

class Course extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'courses';
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

    public function getByTeacherId($teacherId): array
    {
        return $this->where('teacher_id', $teacherId)->findAll();
    }
    public function countByTeacherId($teacherId): int
    {
        return count($this->getByTeacherId($teacherId));
    }
    public function getAll(): array
    {
        return $this->select('courses.course_id, courses.code, courses.name as name, users.name as teacher_name')->join('users', 'users.id=courses.teacher_id', 'left')->findAll();
    }
    public function count(): int
    {
        return count($this->getAll());
    }
}
