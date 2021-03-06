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
            $config = new \Config\Languages;
            $languages = $config->langs;
            return view('index',[
                'languages'=> $languages
            ]);
        }

        public function error()
        {
            echo view('error');
        }

        public function doku()
        {
            echo view('templates/header', [
                "title" => "Docs"
            ]);
            echo view('api');
            return view('templates/footer');
        }

        public function logout()
        {
            session()->destroy();
            return redirect("/");
        }

        public function settings()
        {
            if(!session()->get('loggedin'))
                return redirect()->to("login");
            echo view('templates/header');
            echo view('settings');
            return view('templates/footer');
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
