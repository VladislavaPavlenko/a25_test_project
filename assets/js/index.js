function aj(oper, param, url_me, callback, async) {
	async = async || false;
	oper = oper || "";
	param = param || '';
	url_me = url_me || "/backend/ajax.php";

	let sended = "oper=" + oper + '&' + param;
	waitRequest = true;
	$.ajax({ url: url_me,
		type: "POST", dataType: "html", data: sended,
		success: function(data) {
			waitRequest = false;

			if (callback) callback(data);
		},
		complete: function() {
			waitRequest = false;	
		},
		async: async, cache: false
	});
}

function check_positive_numeric_input($id_input) {
	let number = $id_input.val();
	let error = false;

	if (number == "" || number < 1) {
		$("#form #days").addClass('has_error');
		error = true;
	} else {
		$("#form #days").removeClass('has_error');
	}

	return error;
};

function count_price() {
	let error = check_positive_numeric_input($("#form #days"));

	if (error) {
		$("#total_price").html("");
		return false;
	}

	let dop_price = [];
	$("[id^='dop_price']:checked").each(function() {
		dop_price.push($(this).val());
	});

	dop_price = dop_price.join();
	
	let params = {
		product_id: $("#form #product").val(),
		days: $("#form #days").val(),
		dop_price
	};

	aj("count_price", $.param(params), "", function(data) {
		data = JSON.parse(data);
		if (data['error']) alert(data['error']);
		$("#total_price").html("<h5>ИТОГОВАЯ ЦЕНА: " + data['total_price'] + "</h5>");
	});
}
