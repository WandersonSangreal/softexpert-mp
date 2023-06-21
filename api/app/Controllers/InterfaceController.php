<?php

namespace App\Controllers;

use App\Models\Model;

interface InterfaceController
{
	public function fields(): array;

	public function model(): Model;

}
