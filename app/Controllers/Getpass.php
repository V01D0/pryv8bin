<?php

    namespace App\Controllers;
	use App\Models\paste_new;
	use App\Models\view_paste;

	class Getpass extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
		public function index()
		{
			$request = service('request');
			$db = db_connect();
			$model = new view_paste($db);
			$data = $request->getPost();

			//IF PASTE IS ONLY BURN AFTER READ
			if((!isset($data['link']) && isset($data['burnit'])))
			{
				$link = $data['burnit'];
				$model = new paste_new($db);
				if(!$model->isNameInDB($link))
					return view("error", [
						"reason" => "The paste you are looking for does not exist" 
					]);
				session()->set([$link=>true]);
				return redirect()->to("p/$link");
			}

			if(!isset($data['password']))
				return view('error',[
					"reason" => "Invalid password"
				]);

			$link = $data['link'];
			$password = $data['password']; 
			//IF PASSWORD MATCHES
			if($model->verifyPassword($link, $password))
			{
				session()->set([$link=>true]);
				$model->updateViews($link);
				return redirect()->to("p/$link");
			}
			//ELSE
			return view('error',[
				"reason" => "Invalid password"
			]);
		}
	}
		