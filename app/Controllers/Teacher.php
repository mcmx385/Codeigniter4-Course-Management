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
        $user_id = $this->userSessionUtil->autoLogout();
        $this->userSessionUtil->autoRedirectRank('teacher');
        $count = $this->courseModel->countByTeacherId($user_id);
        $this->template->teacher('teacher/index', ['count' => $count]);
    }
    public function courses()
    {
        $userid = $this->userSessionUtil->autoLogout();
        $this->userSessionUtil->autoRedirectRank('teacher');
        $teacher_courses = $this->courseModel->getByTeacherId($userid);
        $this->template->teacher('teacher/courses', ['teacher_courses' => $teacher_courses]);
    }
}
