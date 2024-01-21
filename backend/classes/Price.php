<?php
namespace backend\classes;

class Price
{
	public $days = 1;
	public $product_id;
	public $dop_price = 0;

	function __construct(array $params)
	{
		$this->days = (int)$params['days'];
		$this->product_id = $params['product_id'];
		$this->dop_price = $params['dop_price'];
	}

	public function count_price()
	{
		$price = 0;

		$product_tarifs = $this->get_tarif_by_product_id($this->product_id);
		
		if (is_array($product_tarifs)) {
			$days_intervals = [];
			$days_variations = array_keys($product_tarifs);

			for ($i = 0; $i < count($days_variations); $i++) {
				if ($i >= 0 && $i < (count($days_variations) - 1)) {
					$days_intervals[] = [$days_variations[$i], $days_variations[$i + 1] - 1];
				}
			}

			$main_product_price = 0;
			foreach ($days_intervals as $interval) {
				if ($this->days >= $interval[0] && $this->days <= $interval[1]) {
					$main_product_price = $product_tarifs[$interval[0]];
					break;
				}
			}

			if ($main_product_price == 0) $main_product_price = array_pop($product_tarifs);
		} else {
			$main_product_price = $product_tarifs;
		}

		$price += $main_product_price * $this->days;

		if (!empty($this->dop_price)) {
			foreach ($this->dop_price as $dop) {
				$price += $dop * $this->days;
			}
		}

		return $price;
	}

	private function get_tarif_by_product_id($id)
	{
		global $dbh;
		$product_info = $dbh->mselect_rows('a25_products', ['ID' => $id], 0, 1, 'id')[0];
		
		if (!empty($product_info['TARIFF'])) {
			$producct_tarif = unserialize($product_info['TARIFF']);
		} else {
			$producct_tarif = $product_info['PRICE'];
		}
		return $producct_tarif;
	}
}

