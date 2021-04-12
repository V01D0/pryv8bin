<?php

    namespace App\Controllers;

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

        public function error()
        {
            echo view('error');
        }

        public function view($page = 'index')
        {
            if (!is_file(APPPATH . '/Views/pages/' . $page . '.php'))
            {
                // Whoops, we don't have a page for that!
                throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter

            echo view('templates/header', $data);
            echo view('pages/' . $page, $data);
            echo view('templates/footer', $data);
        }
    }
