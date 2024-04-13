<?php

namespace App\Libraries;

define('LOGGED_IN_MESSAGE', 'You are logged in.');
define('LOGGED_OUT_MESSAGE', 'You are logged out.');
define('LOGIN_REQUIRED_MESSAGE', 'You need to login first.');
define('INSUFFICIENT_PERMISSION_MESSAGE', 'You do not have permission to access this page.');

define('LOGIN_URL', '/user/login');
define('LOGOUT_URL', '/user/logout');
define('STUDENT_DEFAULT_URL', '/student/courses');
define('TEACHER_DEFAULT_URL', '/teacher/courses');
define('ADMIN_DEFAULT_URL', '/admin');
define('DEFAULT_URL', '/home');

class PageAccessUtil
{
    private $userModel;
    private $userSessionUtil;
    private $urlUtil;

    public function __construct()
    {
        $this->userModel = new \App\Models\User();
        $this->userSessionUtil = new \App\Libraries\UserSessionUtil();
        $this->urlUtil = new \App\Libraries\UrlUtil();
    }

    public function autoRedirectToLoggedInPage()
    {
        if ($this->userSessionUtil->isLoggedIn()) {
            $userId = $this->userSessionUtil->getUserId();
            $userRank = $this->userModel->findRankByUserId($userId);
            $this->redirectToLoggedInPageByRank($userRank);
            return $userId;
        }
    }

    public function redirectToLoggedInPageByRank(string $userRank)
    {
        $status = isset($_GET['status']) ? $_GET['status'] : LOGGED_IN_MESSAGE;
        if ($userRank == 'student') {
            $this->urlUtil->goToUrlWithStatus(STUDENT_DEFAULT_URL, $status);
        } elseif ($userRank == 'teacher') {
            $this->urlUtil->goToUrlWithStatus(TEACHER_DEFAULT_URL, $status);
        } elseif ($userRank == 'admin') {
            $this->urlUtil->goToUrlWithStatus(ADMIN_DEFAULT_URL, $status);
        } else {
            $this->urlUtil->goToUrlWithStatus(DEFAULT_URL, $status);
        }
    }

    public function validateOrRedirectLoggedIn()
    {
        if (!$this->userSessionUtil->isLoggedIn()) {
            $this->goToLoginPageWithStatus(LOGIN_REQUIRED_MESSAGE);
        }
    }

    public function validateOrRedirectRank(array $targetRanks)
    {
        $this->validateOrRedirectLoggedIn();
        $userId = $this->userSessionUtil->getUserId();
        $userRank = $this->userModel->findRankByUserId($userId);
        if (!in_array($userRank, $targetRanks)) {
            $this->goToLoginPageWithStatus(INSUFFICIENT_PERMISSION_MESSAGE);
        }
    }

    public function goToLoginPageWithStatus(string $status = '')
    {
        $this->urlUtil->goToUrl(LOGIN_URL . '?status=' . urlencode($status));
    }

    public function goToLogoutPageWithStatus(string $status = LOGGED_OUT_MESSAGE)
    {
        $this->urlUtil->goToUrl(LOGOUT_URL . '?status=' . urlencode($status));
    }
}