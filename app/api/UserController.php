<?php
use Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        $this->response([
            "Users" => []
        ]);
    }
}