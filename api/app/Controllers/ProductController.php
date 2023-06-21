<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Product;

class ProductController extends AbstractController
{
	public function model(): Model
	{
		return new Product();
	}

	public function fields(): array
	{
		return ['id', 'name', 'type_id', 'price', 'created_date'];
	}
}
