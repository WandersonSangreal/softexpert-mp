<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Tax;

class TaxController extends AbstractController
{
	public function model(): Model
	{
		return new Tax();
	}

	public function fields(): array
	{
		return ['id', 'percentage'];
	}
}
