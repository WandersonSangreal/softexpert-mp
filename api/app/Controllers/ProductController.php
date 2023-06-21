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

	public function store()
	{
		$products = new Product();

		$created = $products->create(['name' => 'Teste', 'type_id' => 1, 'price' => '3000', 'description' => "Teste"]);

		return json_encode($created);
	}

	public function update()
	{
		$products = new Product();

		$created = $products->update(['name' => 'Teste', 'type_id' => 1, 'price' => '3000', 'description' => "Teste"])->where('id', 2);

		return json_encode($created);
	}

}
