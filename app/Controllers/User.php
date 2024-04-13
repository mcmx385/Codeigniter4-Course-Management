<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login()
    {
        $this->userUtil->autoLogin();
        $this->template->user('user/login');
    }
    public function signup()
    {
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
        $this->userUtil->autoLogout();
        $this->template->user('user/index');
    }
    public function auth()
    {
        $this->userUtil->autoLogin();
        $user = $this->userModel->existUsernameAndPassword($_POST['username'], $_POST['password']);
        if ($user) {
            echo "User valid";
            $_SESSION['userid'] = $user->id;
            $_SESSION['username'] = $user->name;
            $_SESSION['loggedin'] = true;
            $user_rank = $this->userModel->findRankByUserId($user->id);
            $this->userUtil->redirectRank($user_rank);
        } else {
            echo "User invalid";
            header('location: /user/login?status=' . urlencode('username or password invalid'));
            exit;
        }
    }
    public function logout()
    {
        $this->userUtil->logout($this->session);
    }
}
