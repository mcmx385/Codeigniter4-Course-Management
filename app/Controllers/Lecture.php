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
    public function attendance($courseId = null, $lectureId = null)
    {
        $this->pageAccessUtil->validateOrRedirectRank(['teacher', 'admin']);
        $lectures = $this->courseLectureModel->findByCourseId($courseId);
        $students = [];
        if ($lectureId !== null) {
            $students = $this->db->table('users')
                ->select('users.id as userid, name, attendanceId')
                ->where('users.rank', 'student')
                ->join('lecture_attendance', 'lecture_attendance.lectureId=' . $lectureId . ' and lecture_attendance.studentId=users.id', 'left')
                ->get()->getResult();
        }
        $this->template->teacher('lecture/attendance', ['lectures' => $lectures, 'courseId' => $courseId, 'lectureId' => $lectureId, 'students' => $students]);
    }
    public function urls($courseId = null)
    {
        $this->pageAccessUtil->validateOrRedirectRank(['teacher', 'admin']);
        $lectures = $this->courseLectureModel->findByCourseId($courseId);
        $this->template->teacher('lecture/urls', ['lectures' => $lectures, 'courseId' => $courseId]);
    }
    public function add_lecture($courseId)
    {
        $courseLecture = [
            'courseId' => $courseId,
            'date' => $_POST['date'],
            'startTime' => $_POST['startTime'],
            'endTime' => $_POST['endTime'],
        ];
        $this->courseLectureModel->save($courseLecture);
        $this->urlUtil->goToPreviousUrl();
    }
    /*
        get lecture and student id from url or from session
        also need check if student is in this course
    */
    public function take_attendance($enter = 0, $lectureId = null, $studentId = null)
    {
        $status = 'error occured or try login first';
        if ($studentId == null && session_status() === PHP_SESSION_ACTIVE) {
            $studentId = $_SESSION['userid'];
        }
        if ($lectureId !== null && $studentId !== null) {
            $lecture_info = $this->courseLectureModel->findByLectureId($lectureId);
            $curr_date = date('Y-m-d');
            $curr_time = date('H:i:s');
            if ($curr_date == $lecture_info->date && strtotime($curr_time) > strtotime($lecture_info->startTime) && strtotime($curr_time) < strtotime($lecture_info->endTime)) {
                if ($this->lectureAttendanceModel->saveByLectureIdAndStudentId($lectureId, $studentId)) {
                    $status = 'attendance taken';
                } else {
                    $status = 'already taken';
                }
                if ($enter) {
                    $this->urlUtil->goToUrl('/lecture/details/' . $lectureId);
                }
            } else {
                $status = 'not between lecture time';
            }
        }
        $this->urlUtil->goToUrl(strtok($_SERVER['HTTP_REFERER'], '?') . '?status=' . urlencode($status));
    }
    public function attendance_record($courseId)
    {
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
        $userId = $this->userSessionUtil->getUserId();
        $records = $this->db->table('course_lecture')
            ->select('course_lecture.lecture_id, attendance_id, date, start_time, end_time')
            ->where('course_id', $courseId)
            ->join('lecture_attendance', 'lecture_attendance.lecture_id=course_lecture.lecture_id and lecture_attendance.student_id=' . $userId, 'left')
            ->get()->getResult();
        $this->template->student('lecture/attendance_record', ['records' => $records]);
    }
    public function details($lectureId)
    {
        $lecture = $this->courseLectureModel->findByLectureId($lectureId);
        $this->template->student('lecture/details', ['lecture' => $lecture]);
    }
}
