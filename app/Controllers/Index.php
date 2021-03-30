<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Index extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            return view('index');
        }

        public function login()
        {
            $data = [];
            if(session()->get('loggedin'))
                return redirect('/');
            echo view('templates/header', $data);
            echo view('login');
            echo view('templates/footer', $data);
        }
        public function register()
        {
            $data = [];
            if(session()->get('loggedin'))
                return redirect('/');
            echo view('templates/header', $data);
            echo view('register');
            echo view('templates/footer', $data);
        }

        public function error()
        {
            echo view('error');
        }

        public function view($page = 'index')
        {
            if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter

            echo view('templates/header', $data);
            echo view('pages/' . $page, $data);
            echo view('templates/footer', $data);
        }
    }
