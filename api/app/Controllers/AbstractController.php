<?php

namespace App\Controllers;

use App\Models\Product;

abstract class AbstractController implements InterfaceController
{
	public function show($id = null, $returArr = false)
	{
		$products = $this->model();
		$order = method_exists($this, 'order') ? $this->order() : [];

		if (!$id) {

			$results = $products->fetchAll($this->fields(), [], $order);

			if ($returArr) {

				return $results;

			}

			return json_encode($results);

		}

		$results = $products->fetchAll($this->fields(), ['id' => $id], $order);

		if ($returArr) {

			return $results;

		}

		return json_encode($results);
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
