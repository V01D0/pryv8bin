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
        //INITIATE DATABASE CONNECTION
        $db = db_connect();
        //CREATE MODEL VARIABLE
        $model = new paste_new($db);
        // $model = \model('App\Models\paste_new');
        $request = service('request');
        $pasteVars = $request->getPost();
        if ($pasteVars['submit'] !== 'Submit') {
            return view('error');
        }
        // echo $pasteVars['expiry'];
        // return view('result');
        // $ex = $model->parsePaste($pasteVars);
        // $ex = json_decode(json_encode($ex), true);
        // foreach ($ex as $key => $value) {
        //     $ex = $value;
        // }
        // echo $ex;

        $model->parsePaste($pasteVars);
        // return view('result');
        // $model->parsePaste($pasteVars);
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
