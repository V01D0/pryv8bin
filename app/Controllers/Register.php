<?php
	namespace App\Controllers;

	use App\Models\users;

	class Register extends Home
	{
		function __construct()
        {
            parent::__construct();
        }
		function index()
		{
			//IF LOGGED IN, REDIRECT
			if(session()->get('loggedin'))
				return redirect('/');
			//INITIATE DATABASE CONNECTION
			$db = db_connect();
			$request = service('request');
			$creds = $request->getPost();

			if(!isset($creds['submit']) || $creds['submit'] !== 'Submit')
			{
				echo view('templates/header');
				echo view('register');
				return view('templates/footer');
			}

			//CHECK IF INPUT IS VALID
			$valid = $this->validate([
				'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[auth.email]'],
				'password' => ['label'=> 'Password', 'rules' => 'required|min_length[8]'],
				'confirm-password' => ['label'=> 'Confirm Password', 'rules' => 'required|matches[password]']
			]);

			//IF NOT
			if(!$valid)
			{
				echo view('templates/header');
				echo view('register',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}

			//CREATE USERS MODEL OBJECT
			$model = new users($db);
			$email = $creds['email'];
			$password = password_hash($creds['confirm-password'], PASSWORD_ARGON2ID);
			$model->registerUser($email, $password);
			echo view('templates/header');
			echo view('mailsent');
			return view('templates/footer');
		}
		
	}