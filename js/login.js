$(function() {
	window.usuario = {
		email : ''
	}
	$('#frm_login').on('submit',function(ev) {
		ev.preventDefault();
		window.usuario.email = $('#username').val();
		$.ajax({
			'url' : 'controllers/usuario.php',
			'method' : 'POST',
			'data' : {
					'request' : 'get',
					'email' : window.usuario.email
				},
			'dataType' : 'json',
			'jsonp' : false,
			'beforeSend' : function() {
				$('#modal-body').empty();
			},
			'success' : function() {
				$('#modal-body').append('<form id="frm_pass">Password:&nbsp;<input type="password" id="password" name="password" class="form-control" /><button type="submit">Enviar</button></form>');
			},
			'error' : function() {
				$('#modal-body').append('Aspirante:<br />Verifique que su email esté correcto.<br /><form><input type="text" id="email" value="'+
						window.usuario.email+'" /><button type="submit">Enviar</button></form>');
			},
			'complete' : function() {
				$('#btn_modal').trigger('click');
			}
		});
	});
	$('#modal-body').on('submit',function(ev) {
		ev.preventDefault;
		$.ajax({
			'url' : 'controllers/usuario.php',
			'method' : 'POST',
			'data' : {
				'request' : 'login',
				'email' : window.usuario.email,
				'password' : $('#password').val()
			},
			'dataType' : 'json',
			'jsonp' : false,
			'complete' : function() {
				location.reload();
				$('#modal_close').trigger('click');
			}
		});
		return false; // Porfavor que esto ya deje de subir por el DOM!!!
	});
});
