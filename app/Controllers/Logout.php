<?php

    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Logout extends Home
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            session()->destroy();
            return redirect("/");
        }
    }
