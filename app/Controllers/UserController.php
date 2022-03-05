<?php
    require_once 'Controller.php';

    class UserController extends Controller
    {
        public function index() 
        {
            //
            $this->view('welcome');
        }

        public function create($data) 
        {
            print_r($data);
            echo $data['name'];
        }

        public function show() 
        {
            $this->view('homepage');
        }

    }
