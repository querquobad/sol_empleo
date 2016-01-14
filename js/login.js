$(function() {
	$('body').one('shown.bs.modal',function() {
		$('#password').focus();
	});
	$('#frm_login').on('submit',function(ev) {
		ev.preventDefault();
		window.usuario.email = $('#username').val();
		doAjax({
			'type' : 'get',
			'data' : {
					'request' : 'usuario',
					'email' : window.usuario.email,
					'action' : 'validaUsuario'
				},
			'beforeSend' : function() {
				$('#modal-body').empty(); //En caso que hayan ingresado algo y luego cierren el modal
			}
		},function(jqxhr,data,texto) {
			if (data !== false) {
				/*
				 * Poner un password si es usuario y validar email si es aspirante.
				 */
				if (data[0] != undefined && data[0] == true) {
					$('#modal-body').append('<form id="frm_pass">Password:&nbsp;<input type="password" id="password" name="password" class="form-control" /><button type="submit">Enviar</button></form>');
				} else {
					$('#modal-body').append('Aspirante:<br />Verifique que su email esté correcto.<br /><form><input type="text" id="email" value="'+window.usuario.email+'" /><button type="submit">Enviar</button></form>');
				}
				$('#btn_modal').trigger('click'); //Abrir el modal
			} else {
				alert('Ha fallado el ajax');
			}
			return false;
		});
	});
	$('#modal-body').on('submit',function(ev) {
		ev.preventDefault();
		doAjax({
			'method' : 'get',
			'request' : 'usuario',
			'action' : 'login',
			'data' : {
				'request' : 'usuario',
				'action' : 'login',
				'email' : window.usuario.email,
				'password' : $('#password').val()
			},
			'dataType' : 'json',
			'jsonp' : false,
			'complete' : function() {
				location.reload();
				$('#modal_close').trigger('click');
			}
		},function(jqxhr,data,text){
			if (data !== false) {
				// Got the cookie ¿como se valida ésto?
				location.reload();
			} else {
				alert('Error de ajax');
			}
		});
		return false; // Porfavor que esto ya deje de subir por el DOM!!!
	});
});
