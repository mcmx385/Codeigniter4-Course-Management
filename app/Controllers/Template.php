<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Template extends Controller
{
    protected $isLoggedIn = false;

    public function __construct()
    {
        $this->isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
    }

    public function user($page = 'home/index', $data = [], $title = 'User')
    {
        echo view('templates/user', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $this->isLoggedIn]);
    }
    public function admin($page = 'home', $data = [], $title = 'Admin')
    {
        echo view('templates/admin', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $this->isLoggedIn]);
    }
    public function student($page = 'home', $data = [], $title = 'Student')
    {
        echo view('templates/student', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $this->isLoggedIn]);
    }
    public function teacher($page = 'home', $data = [], $title = 'Teacher')
    {
        echo view('templates/teacher', ['page' => 'pages/' . $page, 'data' => $data, 'title' => $title, 'isLoggedIn' => $this->isLoggedIn]);
    }
}
