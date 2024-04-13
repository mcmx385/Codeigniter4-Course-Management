<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Lecture extends BaseController
{
    protected $courseModel;
    protected $lectureAttendanceModel;
    protected $courseLectureModel;
    protected $lectureHelper;

    public function __construct()
    {
        $this->courseModel = new \App\Models\Course();
        $this->lectureAttendanceModel = new \App\Models\LectureAttendance();
        $this->courseLectureModel = new \App\Models\CourseLecture();
        $this->lectureHelper = new \App\Helpers\LectureHelper();
    }
    public function attendance($courseId = null, $lectureId = null)
    {
        $this->pageAccessUtil->validateOrRedirectRank(['teacher', 'admin']);
        $lectures = $this->courseLectureModel->findByCourseId($courseId);
        $students = [];
        if ($lectureId !== null) {
            $students = $this->lectureHelper->getStudents($lectureId);
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
        $this->lectureHelper->addLecture($courseId, $_POST['date'], $_POST['startTime'], $_POST['endTime']);
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
            $status = $this->lectureHelper->takeAttendance($enter, $lectureId, $studentId);
        }
        $this->urlUtil->goToUrl(strtok($_SERVER['HTTP_REFERER'], '?') . '?status=' . urlencode($status));
    }

    public function attendance_record($courseId)
    {
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
        $records = $this->lectureHelper->getLectureAttendances($courseId);
        $this->template->student('lecture/attendance_record', ['records' => $records]);
    }
    public function details($lectureId)
    {
        $lecture = $this->courseLectureModel->findByLectureId($lectureId);
        $this->template->student('lecture/details', ['lecture' => $lecture]);
    }
}
