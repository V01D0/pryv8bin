<?php

	namespace App\Controllers;
	use App\Models\users;

	class Verify extends Home
	{
		function __construct()
		{
			parent::__construct();
		}

        function index()
        {
            $db = db_connect();
            $uri = service('uri');
			$type = strtolower($uri->getQuery(['only'=>['t']]));
			$type = explode('=',$type,2);
			if(empty($type) || $type != 'v' || $type != 'r')
				return view('error',[
					"reason" => "Unable to verify your email"
				]);
			
			$hash = $uri->getQuery(['only'=>['hash']]);
			if(empty($hash))
				return view('error',[
					"reason" => "Unable to verify your email"
				]);

			$hash = explode('=',$hash,2);
			$hash = $hash[1];
			$uid = $uri->getQuery(['only'=>['uid']]);
			if(empty($uid))
				return view('error',[
					"reason" => "Unable to verify your email"
				]);

			$uid = explode('=',$uid,2);
			$uid = intval($uid[1]);
			if($uid === 0)
				return view('error',[
					"reason" => "Unable to verify your email"
				]);
            $model = new users($db);
            if($model->verify($hash, $uid, $type))
            {
            	echo view('templates/header');
		    	echo view('verified'); 
            	return view('templates/footer');
            }
			return view('error',[
				"reason" => "Unable to verify your email"
			]);
        }
	}
