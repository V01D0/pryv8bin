<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Index extends Home
{
    function __construct()
    {
        helper('html');
        helper('form');
    }
    public function index()
    {
        return view('index');
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
