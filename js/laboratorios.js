
function init(){
	get_correlativo_orden();
	listado_general_envios();
	document.getElementById("btn_recibir_lab").style.display = "none";
  //document.getElementById("observaciones_ca").style.display = "none";	
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
  let peticion = "creadas";
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

///////////////////LISTADO ORDENES RECIBIDAS
function listado_ordenes_recibidas(){
  document.getElementById("btn_recibir_lab").style.display = "none";
  document.getElementById("btn_enviar_lab").style.display = "none";
  document.getElementById("fecha_ord").innerHTML = "Fecha Recibido";
  document.getElementById("acciones_orden").innerHTML = "Revisión";
  
  var sucursal = $("#sucursal").val();
  let peticion = "recibidas";

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
//****ENVIAR ORDENES******////
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

////////////////////RECIBIR TRABAJOS /////////////////
var items_recibidos = [];
$(document).on('click','.recibir_orden',function(){
	 console.log("holarec Mundo");
  var id_pac = $(this).attr("value");
  var orden = $(this).attr("name");
  let id_item = $(this).attr("id");
  //console.log(`id ${id_pac} orden ${orden} item ${id_item}`)
  var checkbox = document.getElementById(id_item);
  let check_state = checkbox.checked;
  console.log(check_state);

  if (check_state == true) {
  	    let obj = {
       	id_paciente : id_pac,
       	numero_orden : orden
       }
       items_recibidos.push(obj);
  }else if(check_state == false){
	let index = items_recibidos.findIndex(x => x.numero_orden==orden)
	console.log(index)
	items_recibidos.splice(index, 1)
  }
});

function recibir_orden_lab(){
   let  tipo_accion = "Recibir de laboratorio";
   let  id_usuario = $("#id_usuario").val();
   let  sucursal = $("#sucursal").val();

   $.ajax({
   	url:"ajax/ordenes.php?op=registrar_entrega_lab",
    method:"POST",
    data:{'arrayRecibir':JSON.stringify(items_recibidos),'tipo_accion':tipo_accion,'id_usuario':id_usuario,'sucursal':sucursal},
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

function aprobar_orden_laboratorio(){

  var numero_orden = $("#numero_orden_ca").val();
  var id_paciente =$("#id_paciente_ca").val();
  var estado_varilla = [];
  var estado_frente = [];
  var codos_flex = [];
  var graduaciones = [];
  var productos = [];
  var items_malos = [];  
  var observaciones = $("#observaciones_control_ca").val();
  var id_usuario = $("#id_usuario").val();
  let  tipo_accion = "Control de calidad";
  let  sucursal = $("#sucursal").val();
  //let  id_usuario = $("#id_usuario").val();

  $.each($("input[name='estado_var']:checked"), function(){
    estado_varilla.push($(this).val());
  });
  $.each($("input[name='estado_frente']:checked"), function(){
    estado_frente.push($(this).val());
  });
  $.each($("input[name='estado_codos']:checked"), function(){
    codos_flex.push($(this).val());
  });
  $.each($("input[name='estado_graduaciones']:checked"), function(){
    graduaciones.push($(this).val());
  });
  $.each($("input[name='productos_orden']:checked"), function(){
    productos.push($(this).val());
  });
  //console.log(`Estado Varilla ${estado_varilla} Estado frente ${estado_frente} Estado frente ${codos_flex} Estado frente ${graduaciones}`);  
  let estado_varilla_f = estado_varilla.toString();
  let estado_frente_f = estado_frente.toString();
  let codos_flex_f = codos_flex.toString();
  let graduaciones_f = graduaciones.toString();
  let productos_f = productos.toString();
  

  for(var i=0;i < estado_varilla.length;i++){
    if(estado_varilla[i]=="Malo"){
      items_malos.push("1");
    }
  }
  for(var i=0;i < estado_frente.length;i++){
    if(estado_frente[i]=="Malo"){
      items_malos.push("1");
    }
  }
    for(var i=0;i < codos_flex.length;i++){
    if(codos_flex[i]=="Malo"){
      items_malos.push("1");
    }
  }
  for(var i=0;i < graduaciones.length;i++){
    if(graduaciones[i]=="Malo"){
      items_malos.push("1");
    }
  }

if (productos.length == 0) {
  setTimeout ("Swal.fire('Verificar la entrega de Accesorios','','warning')", 100);
  return false; 
}


  if (items_malos.length>0 && observaciones == "") {
    setTimeout ("Swal.fire('Debe colocar una observacion','','error')", 100);
  }else{
    $.ajax({
    url:"ajax/ordenes.php?op=registrar_control_calidad",
    method:"POST",
    data:{numero_orden:numero_orden,id_paciente:id_paciente,estado_varilla_f:estado_varilla_f,estado_frente_f:estado_frente_f,
    codos_flex_f:codos_flex_f,graduaciones_f:graduaciones_f,productos_f:productos_f,observaciones:observaciones,id_usuario:id_usuario,tipo_accion:tipo_accion,sucursal:sucursal},
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

}

function control_calidad_orden(id_paciente,numero_orden){
  $("#cantrol_calidad_ord").modal('show');
  $("#id_paciente_ca").val(id_paciente);
  $("#numero_orden_ca").val(numero_orden);

}

var notas = [];
function contacto_paciente(id_paciente,numero_orden){
  notas = [];
 $("#contactos_pac_orden").modal('show');
 $("#id_pac_contact").val(id_paciente);
 $("#n_orden_contact").val(numero_orden);

 $.ajax({
    url:"ajax/ordenes.php?op=get_datos_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache: false,
    dataType:"json",
      success:function(data){
      $("#evaluado_cont").html(data.evaluado);
      $("#titular_cont").html(data.nombres);
      $("#empresa_cont").html(data.empresas);
      $("#cel_cont").html(data.telefono);
      $("#tel_ofi_c").html(data.telefono_oficina);
      $("#correo_cont").html(data.correo);
      $('#data_envios_lab').DataTable().ajax.reload();
    }     
 
  });

 $.ajax({
    url:"ajax/ordenes.php?op=get_notas_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache: false,
    dataType:"json",
      success:function(data){
      console.log(data);
      for( var i in data){
        var obj = {
          fecha : data[i].fecha,
          usuario : data[i].usuario,
          observaciones : data[i].observaciones
        };
       notas.push(obj);
      }
      listar_notas_de_contacto();
      $('#data_envios_lab').DataTable().ajax.reload();
    }     

  });


}

function listar_notas_de_contacto(){
    $('#listar_notas_contacto').html('');
    var filas = "";

    for(var i=0; i<notas.length; i++){
      var filas = filas + "<tr id='fila"+i+"'><td colspan='15' style='width: 15%'>"+notas[i].fecha+"</td>"+
       "<td colspan='15' style='width: 15%'>"+notas[i].usuario+"</td>"+
      "<td colspan='70' style='width: 70%'>"+notas[i].observaciones+"</td>"+"</tr>";
    }

    $('#listar_notas_contacto').html(filas);
}

function registrar_contacto(){
 let id_paciente = $("#id_pac_contact").val();
 let numero_orden = $("#n_orden_contact").val();
 let observaciones = $("#observaciones_contacto").val();
 let tipo_accion = "LLamada";
 let id_usuario = $("#id_usuario").val();
 let sucursal = $("#sucursal").val(); 
  
  $.ajax({
    url:"ajax/ordenes.php?op=registrar_contacto",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden,observaciones:observaciones,tipo_accion:tipo_accion,id_usuario:id_usuario,sucursal:sucursal},
    dataType:"json",
    success:function(data){
    console.log(data);//return false;
    if(data=="ok"){
    setTimeout ("Swal.fire('Se ha registrado un intento de contacto','','info')", 100);
    $('#data_envios_lab').DataTable().ajax.reload();       
    } 
    }
  }) 

}

init();
