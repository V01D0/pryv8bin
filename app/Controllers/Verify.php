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
			$type = $type[1];
			if(empty($type))
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

			//uid WILL EITHER BE r_id (RESET_ID FOR `lostpass` table) OR VERIFICATION ID (FOR `auth` table)
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
				if($type == 'v')
		    		echo view('verified');
				elseif($type == 'r')
					echo view('reset', [
						"uid"=>$model->getUID($model->getEmail($uid))
					]);
            	return view('templates/footer');
            }
			return view('error',[
				"reason" => "Unable to verify your email"
			]);
        }
	}
