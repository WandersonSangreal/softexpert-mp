<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\Tax;
use App\Models\Type;
use PDO;

class TypeController extends AbstractController
{
	public function show($id = null, $returArr = false)
	{
		$results = parent::show($id, true);

		if ($results) {

			$taxesModel = new Tax();
			$taxes = $taxesModel->fetchAll(['id', 'percentage'], [], [], (PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC));

			$results = array_map(function ($item) use ($taxes) {

				$id = $item['tax_id'];

				unset($item['tax_id']);

				if (array_key_exists($id, $taxes)) {
					$item['tax'] = array_merge(['id' => $id], $taxes[$id]);
				}

				return $item;

			}, $results);

		}

		return json_encode($results);

	}

	public function model(): Model
	{
		return new Type();
	}

	public function fields(): array
	{
		return ['id', 'tax_id', 'name', 'created_date'];
	}
}
