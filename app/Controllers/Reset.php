<?php

    namespace App\Controllers;

    class Reset extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
			if(!session()->get('loggedin'))
				return redirect('/');
			$db = db_connect();
			$request = service('request');
			$creds = $request->getPost();

			if(!isset($creds['submit']) || $creds['submit'] !== 'Submit')
			{
				echo view('templates/header');
				echo view('reset');
				return view('templates/footer');
			}

			//CHECK IF INPUT IS VALID
			$valid = $this->validate([
				'password' => ['label'=> 'Password', 'rules' => 'required|min_length[8]'],
				'confirm-password' => ['label'=> 'Confirm Password', 'rules' => 'required|matches[password]']
			]);

			//IF NOT
			if(!$valid)
			{
				echo view('templates/header');
				echo view('reset',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}
        }
    }
