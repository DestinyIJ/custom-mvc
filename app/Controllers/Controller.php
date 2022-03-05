<?php

    class Controller 
    {
        public function model($model) 
        {
            require_once "../app/Models/" . $model . ".php";

            return new $model();
        }

        public function view($view, $data = [])
        {
            require_once "../../mvc/resources/views/". $view . ".php";
        }
    }