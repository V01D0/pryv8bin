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
        $db = db_connect();
        $model = new paste_new($db);
        // $model = \model('App\Models\paste_new');
        $request = service('request');
        $pasteVars = $request->getPost();
        if (!$request->getPost('submit') && $request->getPost('submit') != 'Submit') {
            echo "ERROR";
            return view('error');
        }
        // echo $pasteVars['expiry'];
        // return view('result');
        $exp = $model->parsePaste($pasteVars);
        var_dump($exp);
        return view('error');
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
