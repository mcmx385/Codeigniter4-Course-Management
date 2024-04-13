<?php

namespace App\Libraries;

class UserSessionUtil
{
    protected $userModel = null;

    public function __construct()
    {
        $this->userModel = new \App\Models\User();
    }

    public function setLoggedIn(string $userId, string $username)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION['userid'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
        }
    }

    public function isLoggedIn()
    {
        return session_status() === PHP_SESSION_ACTIVE
            && isset($_SESSION['username'])
            && isset($_SESSION['loggedin'])
            && $_SESSION['loggedin'] === true;
    }

    public function getUserId()
    {
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['userid'])) {
            return $_SESSION['userid'];
        }
    }

    public function getUsername()
    {
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            unset($_SESSION['userid']);
            unset($_SESSION['username']);
            unset($_SESSION['loggedin']);
            session_destroy();
        }
    }
}
