<?php

    namespace App\Controllers;
	use App\Models\users;

    class Reset extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
			$db = db_connect();
			$request = service('request');
			$creds = $request->getPost();

			if(!session()->get('loggedin') && !isset($creds['uid']))
				return redirect('/');

			if(!isset($creds['submit']) || $creds['submit'] !== 'Submit')
			{
				echo view('templates/header');
				echo view('reset');
				return view('templates/footer');
			}

			//CREATE USERS MODEL OBJECT
			$model = new users($db);
			if(isset($creds['uid']))
			{
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
						'uid' => $creds['uid'],
						'validation' => $this->validator
					]);
					return view('templates/footer');
				}

				$password = password_hash($creds['confirm-password'], PASSWORD_ARGON2ID);
				$model->changePassword($password, $creds['uid']);
				echo view('templates/header');
				echo view('verified', [
					"text" => "Your password as been reset!"
				]);
				return view('templates/footer');
			}

			//CHECK IF INPUT IS VALID
			$valid = $this->validate([
				'old-password' => ['label'=> 'Current Password', 'rules' => 'required'],
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
