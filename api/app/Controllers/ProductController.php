<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Type;
use PDO;

class ProductController extends AbstractController
{
	public function show($id = null, $returArr = false)
	{
		$results = parent::show($id, true);

		if ($results) {

			$taxesModel = new Tax();
			$typesModel = new Type();
			$taxes = $taxesModel->fetchAll(['id', 'percentage'], [], [], (PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC));
			$types = $typesModel->fetchAll(['id', 'name', 'tax_id'], [], [], (PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC));

			$results = array_map(function ($item) use ($types, $taxes) {

				$id = $item['type_id'];

				unset($item['type_id']);

				if (array_key_exists($id, $types)) {
					if (array_key_exists($types[$id]['tax_id'], $taxes)) {
						$types[$id] = array_merge($types[$id], $taxes[$types[$id]['tax_id']]);
					}
					unset($types[$id]['tax_id']);
					$item['type'] = array_merge(['id' => $id], $types[$id]);
				}

				return $item;

			}, $results);

		}

		return json_encode($results);

	}

	public function model(): Model
	{
		return new Product();
	}

	public function fields(): array
	{
		return ['id', 'name', 'description', 'type_id', 'price', 'created_date'];
	}

	public function order(): array
	{
		return ['created_date' => 'desc'];
	}
}
