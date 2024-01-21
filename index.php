<?php
require_once 'backend/sdbh.php';
require_once 'backend/functions.php';

$dbh = new sdbh();

ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/style_form.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row row-header">
				<div class="col-12">
					<img src="assets/img/logo.png" alt="logo" style="max-height:50px"/>
					<h1>Прокат</h1>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row row-body">
				<div class="col-3">
					<h4><span style="text-align: center">Форма расчета:</span></h4>
					<i class="bi bi-activity"></i>
				</div>
				<div class="col-9">
					<div action="" id="form">
						<label class="form-label" for="product">Выберите продукт:</label>
						<select class="form-select" name="product" id="product">
							<?=get_products_html();?>
						</select>

						<label for="customRange1" class="form-label">Количество дней:</label>
						<input type="number" class="form-control" id="days" min="1">

						<label for="customRange1" class="form-label">Дополнительно:</label>

						<?=get_dop_services_html();?>
						<br>
						<button  class="btn btn-primary" onclick='count_price()'>Рассчитать</button>
					</div>
					<br>
					<div id="total_price">

					</div>
				</div>
			</div>
		</div>
   </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.3.js" ></script>
<script src="/assets/js/index.js"></script>
