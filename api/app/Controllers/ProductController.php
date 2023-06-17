<?php

namespace App\Controllers;

class ProductController
{
	public function index()
	{
		header('Content-Type: text/plain; charset=utf-8');
		var_dump('index');
		exit();
	}
}
