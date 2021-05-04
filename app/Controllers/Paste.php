<?php

namespace App\Controllers;

use App\Models\paste_new;

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

        $request = service('request');
        $pasteVars = $request->getPost();
        if(!isset($pasteVars['submit']))
            return redirect()->to('/');

        if ($pasteVars['submit'] !== 'Submit')
            return view('error');

        $link = $model->parsePaste($pasteVars);

        return redirect()->to("p/$link");
    }
}
