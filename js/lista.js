$(function() {
	$('#tbl_aspirantes').DataTable({
		'autoWidth' : true,
		'ajax' : {
			'url' : 'controllers/usuario.php',
			'method' : 'POST',
			'data' : {
				'request' : 'get'
			},
			'dataType' : 'json',
			'jsonp' : false,
			'error' : function() {},
			'complete' : function() {}
		},
		'columns' : [
			//{'data' : 'id','render' : null},
			{'data' : 'nombre', 'width' : '15%'},
			{'data' : 'apellidos', 'width' : '15%'},
			{'data' : 'fecha_nacimiento', 'width' : '15%'},
			{
				'data' : 'sexo',
				'render' : function(data,type,row,meta) {
					if (data == '1') return 'masculino'
					return 'femenino'
				},
				'width' : '15%'
			},
			{'data' : 'email', 'width' : '15%'},
			{
				'data' : 'id',
				'orderable' : false,
				'render' : function(data,type,row,meta) {
					return '<button class="details_btn" type="button" data-fila="'+meta.row+'" data-aspirante="'+data+'"> + Detalles</button>'+
						'<button class="edit_btn" type="button" style="display : none" data-fila="'+meta.row+'" data-aspirante="'+data+'">Editar</button>';
				}
			}
		]
	});
	$('#tbl_aspirantes').on('click','button',{},function(ev) {
		var idx = ev.target.dataset.fila
		var row = $('#tbl_aspirantes').DataTable().row(idx);
		if (row.child.isShown()) {
			$(ev.target).closest('tr').trigger('hide_chld',idx);
		} else {
			$(ev.target).closest('tr').trigger('show_chld',idx);
		}
	}).on('hide_chld',function(ev,row) {
		var row = $('#tbl_aspirantes').DataTable().row(row);
		row.child.hide();
		$(ev.target).find('button.edit_btn').hide();
		$(ev.target).find('button.details_btn').html(' + Detalles');
	}).on('show_chld',function(ev,row){
		$('#tbl_aspirantes').find('tr').each(function() {
			var idx = $(this).find('button.details_btn').data('fila');
			$(this).trigger('hide_chld',idx);
		});
		var datos = $('#tbl_aspirantes').DataTable().row(row).data();
		$('#tbl_aspirantes').DataTable().row(row).child('<table class="table">'+
				'<tr><td>Nacionalidad:</td><td>'+datos.nacionalidad+'</td><td>Lugar de nacimiento:</td><td>'+datos.lugar_nacimiento+'</td>'+
					'<td>Estado civil:</td><td>'+datos.estado_civil+'</td></tr>'+
				'<tr><td>Religión:</td><td>'+datos.religion+'</td><td>Vive en casa:</td><td>'+datos.tipo_casa+'</td>'+
					'<td>Vive con:</td><td>'+datos.vivienda_compartida+'</td></tr>'+
			'</table>').show();
		$(ev.target).find('button.details_btn').html('Ocultar detalles');
		$(ev.target).find('button.edit_btn').show();
	});
});
