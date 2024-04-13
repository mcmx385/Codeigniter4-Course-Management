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
        $this->pageAccessUtil->validateOrRedirectRank(['student', 'admin']);
        $count = $this->courseModel->count();
        $this->template->student('student/index', ['count' => $count]);
    }

    public function courses()
    {
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
        $courses = $this->courseModel->getAll();
        $this->template->student('student/courses', ['courses' => $courses]);
    }
}
