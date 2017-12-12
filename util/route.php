<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 11.12.2017
 * Time: 13:54
 */

class route
{
    private $model;
    private $view;
    private $controller;

    function __construct($model, $view, $controller)
    {
        $this->model = $model;
        $this->view = $view;
        $this->controller = $controller;
    }

}