<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Lecture extends BaseController
{
    protected $courseModel;
    protected $lectureAttendanceModel;
    protected $courseLectureModel;

    public function __construct()
    {
        $this->courseModel = new \App\Models\Course();
        $this->lectureAttendanceModel = new \App\Models\LectureAttendance();
        $this->courseLectureModel = new \App\Models\CourseLecture();
    }
    public function attendance($course_id = null, $lecture_id = null)
    {
        $this->userSessionUtil->autoLogout();
        $this->userSessionUtil->autoRedirectRank('teacher');
        $lectures = $this->courseLectureModel->findByCourseId($course_id);
        $students = [];
        if ($lecture_id !== null) {
            $students = $this->db->table('users')
                ->select('users.id as userid, name, attendance_id')
                ->where('users.rank', 'student')
                ->join('lecture_attendance', 'lecture_attendance.lecture_id=' . $lecture_id . ' and lecture_attendance.student_id=users.id', 'left')
                ->get()->getResult();
        }
        $this->template->teacher('lecture/attendance', ['lectures' => $lectures, 'course_id' => $course_id, 'lecture_id' => $lecture_id, 'students' => $students]);
    }
    public function urls($course_id = null)
    {
        $this->userSessionUtil->autoLogout();
        $this->userSessionUtil->autoRedirectRank('teacher');
        $lectures = $this->courseLectureModel->findByCourseId($course_id);
        $this->template->teacher('lecture/urls', ['lectures' => $lectures, 'course_id' => $course_id]);
    }
    public function addLecture($course_id)
    {
        $data = [
            'course_id' => $course_id,
            'date' => $_POST['date'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
        ];
        $this->courseLectureModel->save($data);
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    /*
       get lecture and student id from url or from session
       also need check if student is in this course
       */
    public function takeAttendance($enter = 0, $lecture_id = null, $student_id = null)
    {
        $status = 'error occured or try login first';
        if ($student_id == null && session_status() === PHP_SESSION_ACTIVE) {
            $student_id = $_SESSION['userid'];
        }
        if ($lecture_id !== null && $student_id !== null) {
            $lecture_info = $this->courseLectureModel->findByLectureId($lecture_id);
            $curr_date = date('Y-m-d');
            $curr_time = date('H:i:s');
            if ($curr_date == $lecture_info->date && strtotime($curr_time) > strtotime($lecture_info->start_time) && strtotime($curr_time) < strtotime($lecture_info->end_time)) {
                if ($this->lectureAttendanceModel->saveByLectureIdAndStudentId($lecture_id, $student_id)) {
                    $status = 'attendance taken';
                } else {
                    $status = 'already taken';
                }
                if ($enter) {
                    $this->urlUtil->goToUrl('/lecture/details/' . $lecture_id);
                }
            } else {
                $status = 'not between lecture time';
            }
        }
        $this->urlUtil->goToUrl(strtok($_SERVER['HTTP_REFERER'], '?') . '?status=' . urlencode($status));
    }
    public function attendance_record($course_id)
    {
        $userid = $this->userSessionUtil->autoLogout();
        $records = $this->db->table('course_lecture')
            ->select('course_lecture.lecture_id, attendance_id, date, start_time, end_time')
            ->where('course_id', $course_id)
            ->join('lecture_attendance', 'lecture_attendance.lecture_id=course_lecture.lecture_id and lecture_attendance.student_id=' . $userid, 'left')
            ->get()->getResult();
        $this->template->student('lecture/attendance_record', ['records' => $records]);
    }
    public function details($lecture_id)
    {
        $lecture = $this->courseLectureModel->findByLectureId($lecture_id);
        $this->template->student('lecture/details', ['lecture' => $lecture]);
    }
}
