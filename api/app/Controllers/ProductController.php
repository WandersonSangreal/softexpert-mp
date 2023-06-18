<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
	public function index()
	{
		$products = new Product(['name' => 'Guitarra', 'type_id' => 1, 'price' => '3000']);

		# $products->save();

		header('Content-Type: text/plain; charset=utf-8');
		var_dump($products);
		exit();
	}
}
