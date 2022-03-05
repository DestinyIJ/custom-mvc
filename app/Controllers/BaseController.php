<?php
    require_once 'Controller.php';

    class BaseController extends Controller
    {
        public function index() 
        {
            //
            $this->view('welcome');
        }

        public function error() 
        {
            //
            $this->view('404');
        }

        
    }
