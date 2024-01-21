<?php
/**
 * @return html element
*/
function get_products_html() {
	global $dbh;

	$products = $dbh->get_all_assoc($dbh->query_exc("SELECT * FROM a25_products"));

	$options = [];
	foreach ($products as $product) {
		$options[$product['ID']] = [
			'name' => $product['NAME'],
		];
	}

	return create_select_options($options);
}

/**
 * @return html element
*/
function create_select_options(array $optionsValues, string $activeKey = '-1', bool $selectDefault = true, string $stringForDefaultSelect = "Выберите") {
	$optionsHtml = '';
	
	$activeKey = explode('/', $activeKey);
	foreach ($optionsValues as $id => $option) {
		$optionName = $option['name'];
		$optionsHtml .= "<option value='$id'>$optionName</option>";
	}
	
	return $optionsHtml;
}

/**
 *
 * @return html element
*/
function get_dop_services_html() {
	global $dbh;

	$services = unserialize($dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value']);

	$html = "";
	$num = 1;

	foreach ($services as $service => $price) {
		$html .= "
			<div class='form-check'>
				<input class='form-check-input' type='checkbox' value='$price' id='dop_price_$num'>
				<label class='form-check-label' for='flexCheckChecked1'>
						$service: $price
				</label>
			</div>
		";

		$num++;
	}

	return $html;
}
