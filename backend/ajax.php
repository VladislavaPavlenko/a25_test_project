<?php
require_once '..\backend\sdbh.php';
include '..\backend\classes\Price.php';
use backend\classes\Price;

$oper = $_POST['oper'];
$dbh = new sdbh();

switch ($oper) {
	case "count_price":
		$params = [
			'product_id' => $_POST['product_id'],
			'days' => $_POST['days'],
			'dop_price' => !empty($_POST['dop_price']) ? explode(',', $_POST['dop_price']) : [],
		];

		$price = new Price($params);
		
		$totalPrice = $price->count_price();
		echo json_encode(['total_price' => $totalPrice]);
	break;

	default:
    echo json_encode(['error' => "Ошибка"]);
}
