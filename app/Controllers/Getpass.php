<?php

    namespace App\Controllers;
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
			$data = $request->getPost();
			if(!isset($data['password']))
				return view('error');
			$link = $data['link'];
			$password = $data['password']; 
			$model = new view_paste($db);
			// if($model->verifyPassword($link, $password))
			// {
			// 	echo view("templates/header");
			// 	$res = $model->getPaste($link);
			// 	if($model->isLarge($link))
			// 		$res .= file_get_contents(WRITEPATH . $link . '.txt');
			// 	echo view("result", [
			// 		'paste' => $res
			// 	]);
			// 	return view("templates/footer");
			// }
			// echo view("templates/header");
			// echo view("askpass", [
			// 	'link'=> $link
			// ]);
			// return view("templates/footer");
			if($model->verifyPassword($link, $password))
			{
				session()->set([$link=>true]);
				return redirect()->to("p/$link");
			}
		}
	}
		