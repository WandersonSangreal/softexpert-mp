<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Type;

class TypeController extends AbstractController
{
	public function model(): Model
	{
		return new Type();
	}

	public function fields(): array
	{
		return ['id', 'tax_id', 'name'];
	}
}
