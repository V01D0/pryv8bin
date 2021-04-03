<?php

    namespace App\Controllers;
    use App\Models\view_paste;

	class P extends Home
    {
        function __construct()
        {
            parent::__construct();
        }
		
		public function index()
        {
            $uri = current_url(true);
            if(trim(empty($uri->getSegment(2))))
                return view("error");
            else
            {
				if($uri->getTotalSegments()>2)
				{
					return redirect("/");
				}
                $link = trim(strtolower($uri->getSegment(2)));
                $db = db_connect();
                $model = new view_paste($db);
				$res = $model->getPaste($link);
				if(!$res)
					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				
				else
				{
					if($model->hasPassword($link) && is_null(session()->get($link)))
					{
						echo view("templates/header");
						echo view("askpass", [
							'link'=> $link
						]);
						return view("templates/footer");
					}

					if($model->isLarge($link))
						$res .= file_get_contents(WRITEPATH . $link . '.txt');
					
					$title = !$model->getTitle($link) ? "Untitled paste" : $model->getTitle($link);
					if(!session()->has($link))
					{
						$test = $model->updateViews($link);
					}
					else
					{
						$test = "fu";
					}
					session()->set($link, 'visited');
					$views = $model->getViews($link);
					$author = $model->getAuthor($link);
					echo view("templates/header", [
						'title' => $title
					]);
					echo view("result", [
						'title' => $title,
						'author' => $author,
						'views' => $views,
						'paste' => $res
					]);
					return view("templates/footer");
				}
            }
        }
	}