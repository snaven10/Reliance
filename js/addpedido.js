function addPedido () {
	$(".aPedido").click(function(event) {
		var Id = $('#vId').val(),
			Can = $('#vCant').val(),
			Pre = $('#vPrecio').val(),
			Cod = $('#vCod').val(),
			Nom = $('#vNombre').val();
			Pre_c = $('#vPre_c').val();
		$.ajax({
			url: '../admin/addSSpedido.php',
			type: 'POST',
			dataType: 'html',
			data: {id:Id, can:Can,
			pre:Pre, cod:Cod, nom:Nom, pre_c:Pre_c },
		})
		.done(function(data) {
			$("#dp").html(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('#myModal').hide();
		});
	});
}
function eliminar_ss(pos) {
	$.ajax({
			url: '../admin/eliminar_ss.php',
			type: 'POST',
			dataType: 'html',
			data: {pos:pos},
		})
		.done(function(data) {
			$("#dp").html(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('#myModal').hide();
			shCont();
		});
}
function shCont () {
	$(".contP").show('slow');
	$("#xp").show('slow');
	$("#vp").hide();
	$("#xp").click(function(event) {
		$(".contP").hide('slow');
		$("#vp").show('slow');
		$("#xp").hide();
	});
}
