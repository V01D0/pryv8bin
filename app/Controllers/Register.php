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
			//INITIATE DATABASE CONNECTION
			$db = db_connect();
			//CREATE MODEL VARIABLE
			$valid = $this->validate([
				'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[auth.email]'],
				'password' => ['label'=> 'Password', 'rules' => 'required|min_length[8]'],
				'confirm-password' => ['label'=> 'Confirm Password', 'rules' => 'required|matches[password]']
			]);
			if(!$valid)
			{
				echo view('templates/header');
				echo view('register',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}
			$request = service('request');
			$creds = $request->getPost();
			if ($creds['submit'] !== 'Submit')
				return view('error');
			
			$model = new users($db);
			$email = $creds['email'];
			$password = password_hash($creds['confirm-password'], PASSWORD_ARGON2ID);
			$model->registerUser($email, $password);
			return view('mailsent');
		}
		
	}