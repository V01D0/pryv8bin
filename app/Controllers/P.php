<?php

    namespace App\Controllers;
    use App\Models\view_paste;
	use App\Models\paste_new;

	class P extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
		
		public function index()
        {
            $uri = current_url(true);
			$db = db_connect();
            if(trim(empty($uri->getSegment(2))))
                return view("error");

				if($uri->getTotalSegments()>2)
					return redirect("/");

                $link = trim(strtolower($uri->getSegment(2)));

				$model = new paste_new($db);

				//IF LINK NAME ISN'T IN THE DATABASE
				if(!$model->isNameInDB($link))
				return view("error", [
					"reason" => "The paste you are looking for does not exist" 
				]);

                $model = new view_paste($db);

				//NO PASSWORD OR BURN AFTER READ
				if(!$model->hasPassword($link) && !$model->isBurn($link) || session()->has($link)) 
					return $this->showPaste($link);

				//PASSWORD AND BURN AFTER READ
				if($model->hasPassword($link) && $model->isBurn($link))
				{
					$burn = true;
					echo view("templates/header");
					echo view("askpass", [
						'link'=> $link,
						'burn' => $burn
					]);
					return view("templates/footer");
				}

				//PASSWORD ONLY
				if($model->hasPassword($link))
				{
					echo view("templates/header");
					echo view("askpass", [
						'link'=> $link,
					]);
					return view("templates/footer");
				}

				//BURN ONLY
				if($model->isBurn($link))
				{
					echo view("templates/header");
					echo view("askpass", [
						'burn'=>$link
					]);
					echo view("templates/footer");
				}
        }

		public function showPaste($link)
		{
			$db = db_connect();
			$model = new view_paste($db);
			$views = $model->getViews($link);
			$author = $model->getAuthor($link);
			$title = !$model->getTitle($link) ? "Untitled paste" : $model->getTitle($link);
			$res = $model->getPaste($link);

			//IF SESSION VAR DOESN'T HAVE LINK
			if(!session()->has($link))
			{
				$model->updateViews($link);
				session()->set($link,true);
			}

			if(!$res)
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

			if($model->isLarge($link))
				$res .= file_get_contents(WRITEPATH . $link . '.txt');

			//PASS TITLE TO <head>
			echo view("templates/header", [
				'title' => $title
			]);
			//RENDER VIEW WITH PASTE INFO
			echo view("result", [
				'title' => $title,
				'author' => $author,
				'views' => $views,
				'paste' => $res
			]);

			//IF LINK IS BURNT, REMOVE SESSION VARIABLE
			if($model->burnLink($link))
				session()->remove($link);
			return view("templates/footer");
		}
	}