<?php

namespace App\Controllers;

define('CREDENTIALS_REQUIRED_MESSAGE', 'The field username or password is invalid.');

class User extends BaseController
{
    public function login()
    {
        $this->pageAccessUtil->autoRedirectToLoggedInPage();
        $this->template->user('user/login');
    }
    public function signup()
    {
        $this->pageAccessUtil->autoRedirectToLoggedInPage();
        $this->template->user('user/signup');
    }
    public function forgot_password()
    {
        $this->template->user('user/forgot_password');
    }
    public function update_password()
    {
        $this->template->user('user/update_password');
    }
    public function reset_password()
    {
        $this->template->user('user/reset_password');
    }
    public function index()
    {
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
        $this->template->user('user/index');
    }

    public function auth()
    {
        try {
            $this->pageAccessUtil->autoRedirectToLoggedInPage();
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (!isset($username) || !isset($password)) {
                throw new \Exception(CREDENTIALS_REQUIRED_MESSAGE);
            }
            $this->userHelper->login($username, $password);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            $this->pageAccessUtil->goToLoginPageWithStatus($e->getMessage());
        }
    }
    public function logout()
    {
        try {
            $this->userHelper->logout();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            $this->pageAccessUtil->goToLoginPageWithStatus($e->getMessage());
        }
    }
}
