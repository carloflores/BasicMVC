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
        $viewController = new \View;
        $viewController::render($view, $data);
    }

    protected function response($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function redirect($path)
    {
        header("Location: {$path}");
        exit;
    }
}