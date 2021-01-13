

//GET DATA NUEVA ORDEN

function get_data_orden(){
 
 let tipo_venta_orden = $("#tipo_venta_orden").val();
 let sucursal_orden = $("#sucursal_orden").val();
 let laboratorio_orden = $("#laboratorio_orden").val();

 if (tipo_venta_orden != "" && sucursal_orden != "" && laboratorio_orden != "") {
 	$("#modal_consultas_orden").modal('show');
	let sucursal="Metrocentro";
	tabla = $('#data_consultas_orden').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',		           
		            'pdf'
		        ],
		"ajax":
				{
					url: 'ajax/ordenes.php?op=get_consultas',
					type : "post",
					dataType : "json",
					data:{sucursal:sucursal},						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();
 }else{
 	Swal.fire('Hay campos que no han sido completados!','','warning')
 }

}

function agregaConsultaOrden(id_paciente,id_consulta,evaluado){
 $("#modal_consultas_orden").modal('hide');
 console.log(`id=${id_paciente} id_consulta =${id_consulta} evaluado ${evaluado}`);
 $.ajax({
	url:"ajax/consultas.php?op=ver_consultas",
	method:"POST",
    data:{id_consulta:id_consulta},
	cache:false,
	dataType:"json",
	success:function(data){
		console.log(data);
		$("#paciente_orden").val(data.p_evaluado);
	 //////////////////////////rx final oI
	    $("#oiesferasf_orden").val(data.oiesferasf);
	    $("#oicolindrosf_orden").val(data.oicolindrosf);
	    $("#oiejesf_orden").val(data.oiejesf);
	    $("#oiprismaf_orden").val(data.oiprismaf);
	    $("#oiadicionf_orden").val(data.oiadicionf);
	    //////////////////////////rx final oD
		$("#odesferasf_orden").val(data.odesferasf);
		$("#odcilindrosf_orden").val(data.odcilindrosf);
		$("#odejesf_orden").val(data.odejesf);
		$("#odprismaf_orden").val(data.dprismaf);
	    $("#oddicionf_orden").val(data.oddicionf);
	    ////////DISTANCIAS INTERPUPILARES
	    $("#dip_od").html(data.oddip);
	    $("#dip_oi").html(data.oidip);
	    $("#ao_od").html(data.aood);
	    $("#ao_oi").html(data.aooi);
	    $("#ap_od").html(data.apod);
	    $("#ap_oi").html(data.opoi);
	    
	}

})

 //////////////////GET NUMERO_VENTA
 $.ajax({
 	url: "ajax/ordenes.php?op=get_numero_venta",
 	method: "POST",
 	data: {id_paciente:id_paciente,evaluado:evaluado},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 		console.log(data);
 		let numero_venta = data.numero_venta;
 		console.log(`Numero venta ${numero_venta}`);
 		get_items_venta(numero_venta,id_paciente);
 	}
 })
}

function get_items_venta(numero_ventas,id_paciente){
	console.log("PPPP"+numero_ventas+"Pac"+id_paciente);
	let numero_venta = numero_ventas;
	console.log(numero_venta)
	$.ajax({
 	url: "ajax/ordenes.php?op=get_items_venta",
 	method: "POST",
 	data: {id_paciente:id_paciente,numero_venta:numero_venta},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 		console.log(data);
 		for(var i in data){
 			console.log(data[i]);
 			let codProd = (data[i]).toString();
 			console.log(codProd);
 			//////////get categoria del producto
 			 $.ajax({
 	         url: "ajax/ordenes.php?op=get_categoria_producto",
 	         method: "POST",
 	         data: {codProd:codProd},
 	         cache:false,
 	         dataType: "json",
 	         success:function(data){
 		     console.log(data);
 		       for(var i in data){
 			   console.log(data[i]);
 			   let catProd = (data[i]).toString();
 			   console.log("Categoria"+catProd);
 		}
 		     
 	}
 })
 		}
 		
 	}
 })
}
