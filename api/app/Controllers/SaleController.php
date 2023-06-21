<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Sale;

class SaleController extends AbstractController
{
	public function model(): Model
	{
		return new Sale();
	}

	public function fields(): array
	{
		return ['id', 'amount', 'product_id', 'price'];
	}
}
