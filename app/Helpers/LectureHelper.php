<?php

namespace App\Helpers;

class LectureHelper
{
    protected $courseLectureModel;
    protected $lectureAttendanceModel;
    protected $urlUtil;
    protected $userSessionUtil;
    protected $db;

    public function __construct()
    {
        $this->courseLectureModel = new \App\Models\CourseLecture();
        $this->lectureAttendanceModel = new \App\Models\LectureAttendance();
        $this->urlUtil = new \App\Libraries\UrlUtil();
        $this->userSessionUtil = new \App\Libraries\UserSessionUtil();
        $this->db = \Config\Database::connect();
    }

    public function addLecture($courseId, $date, $startTime, $endTime)
    {
        $courseLecture = [
            'courseId' => $courseId,
            'date' => $date,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return $this->courseLectureModel->save($courseLecture);
    }

    public function takeAttendance($enter, $lectureId, $studentId)
    {
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
        return $status;
    }

    public function getLectureAttendances($courseId)
    {
        $userId = $this->userSessionUtil->getUserId();
        return $this->db->table('course_lecture')
            ->select('course_lecture.lecture_id, attendance_id, date, start_time, end_time')
            ->where('course_id', $courseId)
            ->join('lecture_attendance', 'lecture_attendance.lecture_id=course_lecture.lecture_id and lecture_attendance.student_id=' . $userId, 'left')
            ->get()->getResult();
    }

    public function getStudents($lectureId)
    {
        return $this->db->table('users')
            ->select('users.id as userid, name, attendanceId')
            ->where('users.rank', 'student')
            ->join('lecture_attendance', 'lecture_attendance.lectureId=' . $lectureId . ' and lecture_attendance.studentId=users.id', 'left')
            ->get()->getResult();
    }
}