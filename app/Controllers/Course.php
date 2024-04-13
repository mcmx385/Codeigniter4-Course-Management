<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Course extends BaseController
{
    protected $lectureAttendanceModel;
    protected $courseStudentModel;

    public function __construct()
    {
        $this->lectureAttendanceModel = new \App\Models\LectureAttendance();
        $this->courseStudentModel = new \App\Models\Coursestudent();
    }

    public function students($courseId)
    {
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
        $students = $this->userModel->findByRank('student');
        $this->template->teacher('course/students', ['students' => $students, 'courseId' => $courseId]);
    }

    public function student_attendance($courseId = null, $studentId = null)
    {
        if ($courseId !== null && $studentId !== null) {
            $studentAttendances = $this->lectureAttendanceModel->findByCourseIdAndStudentId($courseId, $studentId);
        }
        $this->template->teacher('course/student_attendance', ['studentAttendances' => $studentAttendances]);
    }
}
