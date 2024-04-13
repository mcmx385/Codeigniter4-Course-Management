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
    public function students($course_id)
    {
        $this->userUtil->autoLogout();
        $students = $this->userModel->findByRank('student');
        $this->template->teacher('course/students', ['students' => $students, 'course_id' => $course_id]);
    }
    public function student_attendance($course_id = null, $student_id = null)
    {
        if ($course_id !== null && $student_id !== null) {
            $student_records = $this->lectureAttendanceModel->findByCourseIdAndStudentId($course_id, $student_id);
        }
        $this->template->teacher('course/student_attendance', ['student_records' => $student_records]);
    }
}
