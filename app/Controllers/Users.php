<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Users extends Home
    {
        function __construct()
        {
            parent::__construct();
        }

        public function login()
        {
            $data = [];
            if(!session()->get('loggedin'))
            {
                echo view('templates/header', $data);
                echo view('login');
                echo view('templates/footer', $data);
            }
            else
                return redirect("/");
        }

        public function register()
        {
            $data = [];
            if(!session()->get('loggedin'))
            {
                echo view('templates/header', $data);
                echo view('register');
                echo view('templates/footer', $data);
            }
            else
                return redirect("/");
        }

        public function logout()
        {
            session()->destroy();
            return redirect("/");
        }
    }
