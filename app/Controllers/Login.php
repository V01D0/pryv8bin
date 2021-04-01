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
			//CREATE REQUEST OBJECT
			$request = service('request');
			//INITIATE DATABASE CONNECTION
			$db = db_connect();
			$creds = $request->getPost();
			if(!isset($creds['submit']) || $creds['submit'] !== 'Submit')
			{
				echo view('templates/header');
				echo view('login');
				return view('templates/footer');
			}

			$valid = $this->validate([
				'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
				'password' => ['label' => 'Password', 'rules' => 'required']
			]);
			
			if(session()->get('loggedin'))
				return redirect('/');
			if(!$valid)
			{
				echo view('templates/header');
				echo view('login',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}
			
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
				return redirect('/');
			}
			else
			{
				echo view('templates/header');
				echo view('login',[
					'validation' => $this->validator
				]);
				return view('templates/footer');
			}
		}
	}