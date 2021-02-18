<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Paste extends Controller
{
    function __construct()
    {
        helper('html');
        helper('form');
    }
    public function index()
    {
        return view('home');
    }

    public function view($paste = 'home')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $paste . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($paste);
        }

        $data['title'] = ucfirst($paste); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/' . $paste, $data);
        echo view('templates/footer', $data);
    }
}
