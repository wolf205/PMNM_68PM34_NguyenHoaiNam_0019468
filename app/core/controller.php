<?php
class Controller
{
    public function model($model)
    {
        $modelProcessed = ucfirst($model) . 'Model';
        require_once "../app/models/$model.model.php";
        return new $modelProcessed();
    }

    public function view($layout, $view, $data)
    {
        extract($data);
        require_once "../app/views/$layout.php";
    }
}
