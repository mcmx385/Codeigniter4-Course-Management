<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Student extends BaseController
{
    protected $courseStudentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->courseStudentModel = new \App\Models\Coursestudent();
        $this->courseModel = new \App\Models\Course();
    }
    public function index()
    {
        $this->userUtil->autoLogout();
        $this->userUtil->autoRedirectRank('student');
        $count = $this->courseModel->count();
        $this->template->student('student/index', ['count' => $count]);
    }
    public function courses()
    {
        $this->userUtil->autoLogout();
        $courses = $this->courseModel->getAll();
        $this->template->student('student/courses', ['courses' => $courses]);
    }
}
