<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Teacher extends BaseController
{
    protected $courseModel;
    protected $lectureAttendanceModel;
    protected $courseLectureModel;

    public function __construct()
    {
        $this->courseModel = new \App\Models\Course();
        $this->lectureAttendanceModel = new \App\Models\lectureAttendance();
        $this->courseLectureModel = new \App\Models\CourseLecture();
    }
    public function index()
    {
        $this->pageAccessUtil->validateOrRedirectRank(['teacher', 'admin']);
        $userId = $this->userSessionUtil->getUserId();
        $count = $this->courseModel->countByTeacherId($userId);
        $this->template->teacher('teacher/index', ['count' => $count]);
    }
    public function courses()
    {
        $this->pageAccessUtil->validateOrRedirectRank(['teacher', 'admin']);
        $userId = $this->userSessionUtil->getUserId();
        $teacherCourses = $this->courseModel->getByTeacherId($userId);
        $this->template->teacher('teacher/courses', ['teacher_courses' => $teacherCourses]);
    }
}
