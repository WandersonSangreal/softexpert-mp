<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
	public function index()
	{
		$products = new Product();

		$results = $products->fetchAll(['name', 'type_id', 'price']);

		return json_encode($results);

	}
}
