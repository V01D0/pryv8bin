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
				{
					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				}
				else
				{
					echo view("templates/header");
					$isLarge = $model->isLarge($link);
					if($isLarge)
						$res .= file_get_contents(WRITEPATH . $link . '.txt');
					echo view("result", [
						'paste' => $res
					]);
					echo view("templates/footer");
				}
            }
        }
	}