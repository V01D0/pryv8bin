<?php

namespace App\Controllers;

class Home extends BaseController
{
	function __construct()
	{
		helper('html');
		helper('form');
	}
	public function index()
	{
		return view('index');
	}
}
