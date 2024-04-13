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
    protected $userModel;
    protected $userSessionUtil;
    protected $urlUtil;

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
        if ($userRank == 'student') {
            $this->urlUtil->goToUrlWithStatus(STUDENT_DEFAULT_URL, LOGGED_IN_MESSAGE);
        } elseif ($userRank == 'teacher') {
            $this->urlUtil->goToUrlWithStatus(TEACHER_DEFAULT_URL, LOGGED_IN_MESSAGE);
        } elseif ($userRank == 'admin') {
            $this->urlUtil->goToUrlWithStatus(ADMIN_DEFAULT_URL, LOGGED_IN_MESSAGE);
        } else {
            $this->urlUtil->goToUrlWithStatus(DEFAULT_URL, LOGGED_IN_MESSAGE);
        }
    }

    public function validateOrRedirectLoggedIn()
    {
        if (!$this->userSessionUtil->isLoggedIn()) {
            $this->goToLoginPageWithStatus(LOGIN_REQUIRED_MESSAGE);
        }
    }

    public function validateOrRedirectRank(string $targetRank)
    {
        $userRank = $this->userModel->getUserRank();
        if ($userRank !== $targetRank) {
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