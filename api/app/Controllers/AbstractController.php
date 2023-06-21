<?php

namespace App\Controllers;

use App\Models\Product;

abstract class AbstractController implements InterfaceController
{
	public function show($id = null)
	{
		$products = $this->model();

		if (!$id) {
			return json_encode($products->fetchAll($this->fields()));
		}

		return json_encode($products->fetchAll($this->fields(), ['id' => $id]));
	}

	public function store()
	{
		$values = json_decode(file_get_contents('php://input'), true);

		$products = $this->model();

		$created = $products->create($values);

		return json_encode($created);
	}

	public function update($id = null)
	{
		$values = json_decode(file_get_contents('php://input'), true);

		$products = $this->model();

		$created = $products->update($values, ['id' => $id]);

		return json_encode($created);
	}

}
