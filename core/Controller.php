<?php
namespace Core;

class Controller
{
    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    protected function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    protected function response($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}