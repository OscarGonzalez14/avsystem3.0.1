
function init(){
	get_correlativo_orden();
	listado_general_envios();
	document.getElementById("btn_recibir_lab").style.display = "none";	
}
//GET DATA NUEVA ORDEN

function get_data_orden(){
 get_correlativo_orden();
 let tipo_venta_orden = $("#tipo_venta_orden").val();
 let sucursal_orden = $("#sucursal_orden").val();
 let laboratorio_orden = $("#laboratorio_orden").val();


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
		$("#id_consulta_orden").val(id_consulta);
		$("#id_pac_orden").val(id_paciente);
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
	    $("#dip_od").val(data.oddip);
	    $("#dip_oi").val(data.oidip);
	    $("#ao_od").val(data.aood);
	    $("#ao_oi").val(data.aooi);
	    $("#ap_od").val(data.apod);
	    $("#ap_oi").val(data.opoi);
	    
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
 		       for(var i in data){//GET CATEGORIA AROS
 			   console.log(data[i]);
 			   let catProd = (data[i]).toString();
 			   if (catProd=="aros") {
 			   	get_data_aros(codProd);
 		       }else if(catProd=="lentes"){
 		       	get_data_lentes(codProd);
 		       }else if(catProd=="photosensible"){
 		       	get_data_tratamientos(codProd)
 		       }
 		    }//FIN GET CATEGORIA AROS
 		    }
        })//FIN AJAX GET CATEGORIA LENTES
 		} 		
 	}
   })//////////FIN GET ITEMS VENTAS

}


function get_data_aros(codProd){
 //////////////////GET DETALLES DE AROS
 let id_producto = codProd; 
 $.ajax({
 	url: "ajax/ordenes.php?op=get_detalle_aro",
 	method: "POST",
 	data: {id_producto:id_producto},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 	   console.log(data);
 	   $("#modelo_aro_orden").val(data.modelo);
 	   $("#marca_aro_orden").val(data.marca);
 	   $("#color_aro_orden").val(data.color);
 	   $("#diseno_aro_orden").val(data.diseno); 		
 	}
 })
}


function get_data_lentes(codProd){
	let id_producto = codProd;
	$.ajax({
 	url: "ajax/ordenes.php?op=get_detalle_tratamientos",
 	method: "POST",
 	data: {id_producto:id_producto},
 	cache:false,
 	dataType: "json",
 	success:function(data){
 	   console.log(data);
 	   $("#lente_orden").val(data.desc_producto);		
 	}
 })
}

tratamientos = [];
function get_data_tratamientos(codProd){

    let id_producto = codProd;
		$.ajax({
 	    url: "ajax/ordenes.php?op=get_detalle_tratamientos",
 	    method: "POST",
 	    data: {id_producto:id_producto},
 	    cache:false,
 	    dataType: "json",
 	    success:function(data){
 	    console.log(data);
 	    tratamientos.push(" "+data.desc_producto);
 	    tratamientos.toString();
 	    $("#tratamiento_orden").val(tratamientos);

 	}
 })

}

function registrarEnvio(){

	let paciente_orden = $("#paciente_orden").val();
	let laboratorio_orden = $("#laboratorio_orden").val();
	let id_pac_orden = $("#id_pac_orden").val();
	let id_consulta_orden = $("#id_consulta_orden").val();
    
    let  lente_orden =$("#lente_orden").val();    
    let  tratamiento_orden =$("#tratamiento_orden").val();
    let  modelo_aro_orden =$("#modelo_aro_orden").val();
    let  marca_aro_orden =$("#marca_aro_orden").val();
    let  color_aro_orden =$("#color_aro_orden").val();
    let  diseno_aro_orden =$("#diseno_aro_orden").val();

    let  med_a =$("#med_a").val();
    let  med_b =$("#med_b").val();
    let  med_c =$("#med_c").val();
    let  med_d =$("#med_d").val();

    let  observaciones_orden =$("#observaciones_orden").val();
    let  id_usuario = $("#id_usuario").val();
    let  fecha = $("#fecha").val();
    let  sucursal = $("#sucursal").val();
    let  numero_orden = $("#correlativo_orden").html();
    let  prioridad_orden = $("#prioridad_orden").val();

    if(paciente_orden !="" && laboratorio_orden !="" && prioridad_orden !=""){
    $.ajax({
 	   url: "ajax/ordenes.php?op=registrarEnvio",
 	   method: "POST",
 	   data: {paciente_orden:paciente_orden,laboratorio_orden:laboratorio_orden,id_pac_orden:id_pac_orden,id_consulta_orden:id_consulta_orden,
 	   lente_orden:lente_orden,tratamiento_orden:tratamiento_orden,modelo_aro_orden:modelo_aro_orden,marca_aro_orden:marca_aro_orden,
 	   color_aro_orden:color_aro_orden,diseno_aro_orden:diseno_aro_orden,med_a:med_a,med_b:med_b,med_c:med_c,med_d:med_d,observaciones_orden:observaciones_orden,
 	   id_usuario:id_usuario,fecha:fecha,sucursal:sucursal,numero_orden:numero_orden,prioridad_orden:prioridad_orden},
 	   cache:false,
 	   dataType: "json",
 	   success:function(data){
 	   console.log(data);
 	   if (data == "ok") {
 	   	Swal.fire('Envio a laboratorio registrado exitosamente!','','success');
 	   	$("#nueva_orden_lab").modal('hide');
 	   	$('#data_envios_lab').DataTable().ajax.reload();
 	   }else{
 	   	Swal.fire('Correlativo ya Existe,  actualizar navegador!','','error');
 	   }

 	}
})
}else{
Swal.fire('LLEnar los campos obligatorios correctamente!','','error');	
}
}

function get_correlativo_orden(){
	var sucursal = $("#sucursal").val();
	$.ajax({
    url:"ajax/ordenes.php?op=get_numero_orden",
    method:"POST",
    data:{sucursal:sucursal},
    cache:false,
    dataType:"json",
      success:function(data){
    	$("#correlativo_orden").html(data.correlativo);             
      }
    })
}


////////////////////LISTADO GENERAL DE ENVIOS A LABORATORIO
function listado_general_envios(){
	document.getElementById("btn_recibir_lab").style.display = "none";
    document.getElementById("btn_enviar_lab").style.display = "block";
    document.getElementById("fecha_ord").innerHTML = "Fecha Creación";
    document.getElementById("dias_orden").innerHTML = "Dias transcurridos";
  var sucursal = $("#sucursal").val();
  tabla_envios_gral=$('#data_envios_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ordenes',
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
    "iDisplayLength": 25,//Por cada 10 registros hace una paginación
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
}

////////////////////LISTADO ORDENES ENVIADAS
function listado_ordenes_enviadas(){
  document.getElementById("btn_recibir_lab").style.display = "block";
  document.getElementById("btn_enviar_lab").style.display = "none";
  document.getElementById("fecha_ord").innerHTML = "Fecha Envío";
  document.getElementById("dias_orden").innerHTML = "Dias transcurridos";
  var sucursal = $("#sucursal").val();
  let peticion = "envios";
  tabla_envios_gral=$('#data_envios_lab').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ordenes.php?op=listar_ordenes_enviadas',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,peticion:peticion},
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 25,//Por cada 10 registros hace una paginación
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
}
////////////// ACCIONES ORDENES DE LABORATORIOS //////////////////////////

function acciones_envios_lab(id_paciente,numero_orden,evaluado,estado,laboratorio){
	console.log(`id paciente ${id_paciente} numero_orden: ${numero_orden} evaluado: ${evaluado} estado ${estado} laboratorio ${laboratorio}`)
	let tipo_accion = "Envio a Laboratorio";
    let sucursal = $("#sucursal").val();
    let id_usuario	= $("#id_usuario").val();
	if (estado==0) {		
        bootbox.confirm("Confirmar envio a laboratorios "+laboratorio+", la orden de: "+evaluado, function(result){
            if(result){
             // console.log("Holaaaaaa");
              $.ajax({
                url:"ajax/ordenes.php?op=registrar_envio_lab",
                method:"POST",
                data:{id_paciente:id_paciente,numero_orden:numero_orden,evaluado:evaluado,estado:estado,laboratorio:laboratorio,tipo_accion:tipo_accion,sucursal:sucursal,id_usuario:id_usuario},
                dataType:"json",
                success:function(data){
                console.log(data);//return false;
                $('#data_envios_lab').DataTable().ajax.reload();       
        
                }
             })
            }///fin result
        });//bootbox
	}else if(estado == 1){
		////////////LANZAR VENTANA DE CONTROL DE CALIDAD
	}


}
var items_envios = [];

$(document).on('click', '.send_orden', function(){
  console.log("hola Mundo");
  var id_pac = $(this).attr("value");
  var orden = $(this).attr("name");
  let id_item = $(this).attr("id");

  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;
  console.log(check_state);

  if (check_state == true) {
  	    let obj = {
       	id_paciente : id_pac,
       	numero_orden : orden
       }
       items_envios.push(obj);
  }else if(check_state == false){
	let index = items_envios.findIndex(x => x.numero_orden==orden)
	console.log(index)
	items_envios.splice(index, 1)
  }
  
});

function send_orden_lab(){
   let  tipo_accion = "Envio a laboratorio";
   let  id_usuario = $("#id_usuario").val();
   let  sucursal = $("#sucursal").val();

   $.ajax({
   	url:"ajax/ordenes.php?op=registrar_envio_lab",
    method:"POST",
    data:{'arrayEnvio':JSON.stringify(items_envios),'tipo_accion':tipo_accion,'id_usuario':id_usuario,'sucursal':sucursal},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
      },
      success:function(data){
      console.log(data)
       $('#data_envios_lab').DataTable().ajax.reload();
      }     
 
  });

}
init();
