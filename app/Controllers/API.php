<?php

    namespace App\Controllers;
	use App\Models\_api;

	class API extends Home
	{
		function __construct()
        {
            parent::__construct();
        }

		function index()
		{
			if(!session()->get('loggedin'))
				return redirect()->to("login");
			$uri = current_url(true);
            $db = db_connect();
			$request = service('request');
			$submit = $request->getPost();
			if(!isset($submit['submit']))
			{
				echo view("templates/header");
				echo view("api_settings");
				return view("templates/footer");
			}
			else
			{
				echo view("templates/header");
				$model = new _api($db);
				$key = $model->generateKey(random_bytes(16));
				$key = str_replace('-','',$key);
				$email = session()->get("email");
				$model->insertKey($key,$email);
				echo view("api_settings",[
					"key"=> $key
				]);
				// echo $key;
				return view("templates/footer");
			}
				// return redirect()->to("api");

			if ($uri->getTotalSegments() == 1)
			{
				echo view("templates/header");
				echo view("api_settings");
				return view("templates/footer");
			}
			
		}
	}