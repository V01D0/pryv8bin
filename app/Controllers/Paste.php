<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Paste extends Home
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $request = \Config\Services::request();
        $pasteVars = $request->getPost();
        if (!$request->getPost('submit') && $request->getPost('submit') != 'Submit') {
            echo "ERROR";
            return view('error');
        }
        // $nulls = array();
        // foreach ($pasteVars as $var => $val) {
        //     // echo "key = " . $var;
        //     // echo "<br>";
        //     // if (trim($val) == "") {
        //     //     $val = NULL;
        //     // }
        //     // echo "value = " . $val;
        //     // echo "<br>";
        //     if (trim($val) == "") {
        //         array_push($nulls, $var);
        //     }
        //     if (in_array($var, $nulls)) {
        //         $val = NULL;
        //     }
        // }
        // print_r($pasteVars);
        return view('result');
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
