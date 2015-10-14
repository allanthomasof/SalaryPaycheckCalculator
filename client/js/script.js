$(function(){

	var enviando_formulario = false;
	$('.form').submit(function(){
		
		var obj = this;
		var form = $(obj);
		var submit_btn = $('.form :submit');
		var submit_btn_text = submit_btn.val();
		var dados = new FormData(obj);
		
		function volta_submit() {
			submit_btn.removeAttr('disabled');
			submit_btn.val(submit_btn_text);
			enviando_formulario = false;
		}
		
		if ( !enviando_formulario ) {		
			$.ajax({
				beforeSend: function() {
					enviando_formulario = true;
					submit_btn.attr('disabled', true);
					$('.error').remove();
				}, 
				
				url: form.attr('action'),
				type: form.attr('method'),
				data: dados,
				processData: false,
				cache: false,
				contentType: false,
				
				success: function( data ) {	
					volta_submit();
					var data = eval( "(" + data + ")" );
					document.getElementById("inss").innerHTML = data.line_0.toFixed(2);
					document.getElementById("irpf").innerHTML = data.line_1.toFixed(2);
					document.getElementById("salario").innerHTML = data.line_2.toFixed(2);
				},
				error: function (request, status, error) {
					volta_submit();
					
					alert(request.responseText);
				}
			});
		}
		return false;
	});
});