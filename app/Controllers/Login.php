<?php
	namespace App\Controllers;


	use App\Models\users;

	class Login extends Home
	{
		function __construct()
        {
            parent::__construct();
        }

		function index()
		{
			//INITIATE DATABASE CONNECTION
			$db = db_connect();
			$valid = $this->validate([
				'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
				'password' => ['label' => 'Password', 'rules' => 'required']
			]);
			if(!$valid)
			{
				echo view('templates/header');
				echo view('login',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}
			$request = service('request');
			$creds = $request->getPost();
			if($creds['submit'] !== 'Submit')
				return view('error');
			
			$model = new users($db);
			$email = $creds['email'];
			$password = $creds['password'];
			if($model->tryLogin($email, $password))
			{
				$session = session();
				$username = $model->getUsername($email);
				$session->set('username',$username);
				$session->set('uid', $model->getUID($email));
				$session->set('loggedin',1);
				redirect('/');
			}
			else
			{
				echo view('templates/header');
				echo view('login',[
					'validation' => "Incorrect email or password!"
				]);
				return view('templates/footer');
			}
		}
	}