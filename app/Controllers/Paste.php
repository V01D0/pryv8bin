<?php

namespace App\Controllers;

use App\Models\paste_new;
use CodeIgniter\Controller;

class Paste extends Home
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        // $model = \model('App\Models\paste_new');
        $model = new paste_new();
        $request = \Config\Services::request();
        $pasteVars = $request->getPost();
        if (!$request->getPost('submit') && $request->getPost('submit') != 'Submit') {
            echo "ERROR";
            return view('error');
        }
        // $nulls = array();
        // foreach ($pasteVars as $var => $val) {
        //     echo "key = " . $var;
        //     echo "<br>";
        //     if (trim($val) == "") {
        //         $val = "NULL";
        //     }
        //     echo "value = " . $val;
        //     echo "<br>";
        //     // if (trim($val) == "") {
        //     //     array_push($nulls, $var);
        //     // }
        //     // if (in_array($var, $nulls)) {
        //     //     $val = NULL;
        //     // }
        // }
        // return view('result');
        // print_r($pasteVars);
        // switch($pasteVars['expiry']) {
        //     case "never":
        //         $pasteVars['expiry'] = NULL;
        //         break;
        //     case "bar":
        //         $pasteVars['expiry'] = "bar";
        //         break;
        //     case "d1":
        //         $pasteVars['expiry'] = "";
        // }

        $model->parsePaste($pasteVars['paste_content'], $pasteVars['expiry'], $pasteVars['title'], $pasteVars['password']);
        // return view('result');
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
