<?php

use Core\Controller;
class HomeController extends Controller
{
    public function index()
    {
        $this->view('home');
    }
    public function test()
    {
        echo "test";
    }
}