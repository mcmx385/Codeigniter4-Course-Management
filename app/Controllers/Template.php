<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Template extends Controller
{
    public function user($page = 'home/index', $data = [], $title = 'User')
    {
        $isLoggedIn = $this->isLoggedIn();
        echo view('templates/user', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $isLoggedIn]);
    }
    public function admin($page = 'home', $data = [], $title = 'Admin')
    {
        $isLoggedIn = $this->isLoggedIn();
        echo view('templates/admin', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $isLoggedIn]);
    }
    public function student($page = 'home', $data = [], $title = 'Student')
    {
        $isLoggedIn = $this->isLoggedIn();
        echo view('templates/student', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $isLoggedIn]);
    }
    public function teacher($page = 'home', $data = [], $title = 'Teacher')
    {
        $isLoggedIn = $this->isLoggedIn();
        echo view('templates/teacher', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $isLoggedIn]);
    }
    public function isLoggedIn()
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
    }
}
