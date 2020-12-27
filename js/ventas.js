function init() {
  reporte_ventas_gral();
  get_correlativo_venta();
    //get_correlativo_venta();btn_print_recibos
  document.getElementById("btn_print_recibos").style.display = "none";
  document.getElementById("print_factura").style.display = "none";
  document.getElementById("credito_fiscal_print").style.display = "none";

}

$(document).ready(ocultar_btn_post_venta);
  function ocultar_btn_post_venta(){
  get_correlativo_venta();
  document.getElementById("post_venta").style.display = "none";

}
  function mostrar_btn_post_venta(){
  document.getElementById("post_venta").style.display = "flex";
}

//VALDAR TIPO DE PAGO
$(document).ready(function(){
  $("#tipo_venta").change(function () {         
    $("#tipo_venta option:selected").each(function () {
      id_tipo = $(this).val();
      $.post('ajax/ventas.php?op=tipo_pago', { id_tipo: id_tipo }, function(data){
        $("#tipo_pago").html(data);
      });            
    });
  })
});
//VALIDAR CUOTA
$(document).ready(function(){
  $("#tipo_pago").change(function () {
          
    $("#tipo_pago option:selected").each(function () {
      m_cuotas = $(this).val();
      $.post('ajax/ventas.php?op=monto_cuotas', { m_cuotas: m_cuotas }, function(data){
        $("#plazo").html(data);
      });            
    });
  })
});



function get_correlativo_venta(){
  var sucursal_correlativo = $("#sucursal").val();
  $.ajax({
    url:"ajax/ventas.php?op=get_numero_venta",
    method:"POST",
    data:{sucursal_correlativo:sucursal_correlativo},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);        
      $("#n_venta").val(data.correlativo);             
      }
    })
}

var detalles = [];
function agregarDetalleVenta(id_producto,id_ingreso){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_aros_venta",
  method:"POST",
  data:{id_producto:id_producto,id_ingreso:id_ingreso},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);

    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : id_ingreso,
      stock    : data.stock,
      descripcion    : data.desc_producto,
      categoria_ub  : data.categoria_ub,
      num_compra : data.num_compra,
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      categoria_prod : data.categoria_producto
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
   $('#listar_aros_ventas').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax
}


///////////AGEREGAR ACCESORIOS A LA VENTA
var detalles = [];
function agregarAccVenta(id_producto,id_ingreso){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_accesorios_venta",
  method:"POST",
  data:{id_producto:id_producto,id_ingreso:id_ingreso},
  cache: false,
  dataType:"json",
  success:function(data){
   // console.log(data);

 existe_lentes_aros=[];
  for(var i=0;i<detalles.length;i++){
    
    var aro_lente = detalles[i].categoria_prod;
    
    if (aro_lente=="ARO" || aro_lente=="LENTES"){
      existe_lentes_aros.push(aro_lente);
    }
  }
  var long_items = existe_lentes_aros.length;
  if (long_items>0) {
    precio_v=0;
  }else{
    precio_v=data.precio_venta;
  }


    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : id_ingreso,
      stock    : data.stock,
      descripcion    : data.desc_producto,
      categoria : data.categoria,
      categoria_ub  : data.categoria_ub,
      num_compra : data.num_compra,
      precio_venta  : precio_v,
      subtotal : 0,
      descuento : 0,
      categoria_prod : ""
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
   $('#listar_accesorios_ventas').modal("hide");
    console.log(detalles);
    }//fin success
  });//fin de ajax
}

function agregar_detalles_lente_venta(id_producto){
  var consulta = $("#id_consulta").val();
  if(consulta !=""){
  $.ajax({
  url:"ajax/ventas.php?op=agregar_lentes_venta",
  method:"POST",
  data:{id_producto:id_producto},
  cache: false,
  dataType:"json",
  success:function(data){
    console.log(data);
     
    var obj = {
      cantidad : 1,
      codProd  : id_producto,
      id_ingreso   : "",
      stock    : 0,
      descripcion    : data.desc_producto,
      categoria_ub  : "",
      num_compra : "",
      precio_venta  : data.precio_venta,
      subtotal : 0,
      descuento : 0,
      categoria_prod : data.categoria_producto
    };//Fin objeto
    detalles.push(obj);
    listarDetallesVentas();
    $('#listar_lentes_ventas').modal("hide");
    $('#listar_ar_ventas').modal("hide");
    $('#listar_photo_ventas').modal("hide");
    //console.log(detalles);
    }//fin success
  });//fin de ajax
  
}else{
  Swal.fire('Error!. El paciente no posee consulta!','','error')

}
}

/////////////LISTAR DETALLE DE ITEM SELECCIONADOS
function listarDetallesVentas(){

    $('#listar_det_ventas').html('');

    var filas = "";
    //var subtotal = 0;
    var total = 0;

    for(var i=0; i<detalles.length; i++){

      var subtotal = detalles[i].subtotal = detalles[i].cantidad * detalles[i].precio_venta;

      var filas = filas + "<tr id='fila"+i+"'><td>"+(i+1)+
      "</td><td style='text-align:center;'>"+detalles[i].categoria_prod+" "+detalles[i].descripcion+
      "</td><td style='text-align:center'><input style='text-align:right' type='number' class='cantidad form-control' name='cantidad[]' id='cantidad[]' onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+"'>"+
      "<td style='text-align:center'>"+"<span>$</span>"+detalles[i].precio_venta+"</td>"+
      "<td style='text-align:center'><input style='text-align:right' type='number' class='descuento form-control' id='descuento"+(i)+"' onClick='setDescuento(event, this, "+(i)+");' onKeyUp='setDescuento(event, this, "+(i)+");' value='"+detalles[i].descuento+"'>"+
      "</td><td style='text-align:center;'><span>$</span><span style='text-align:right' name='subtotal[]' id=subtotal"+i+" >"+detalles[i].subtotal.toFixed(2)+"</span><td style='text-align:center'><i class='nav-icon fas fa-times-circle fa-2x' onClick='eliminarFila("+i+");' style='color:red'></i></td></tr>";

    //subtotal = subtotal + importe;

  }//cierre for
  $('#listar_det_ventas').html(filas);
  calcularTotales();
}

function setCantidad(event, obj, idx){
    event.preventDefault();
    detalles[idx].cantidad = parseInt(obj.value);
    recalcular(idx);
}

function recalcular(idx){

    console.log(detalles[idx].cantidad);
    console.log((detalles[idx].cantidad * detalles[idx].precio_venta));
    var subtotal =detalles[idx].subtotal = detalles[idx].cantidad * detalles[idx].precio_venta;
    console.log(subtotal.toFixed(2));
    subtotal = detalles[idx].subtotal = (detalles[idx].subtotal - detalles[idx].descuento);

    subtotalFinal = subtotal.toFixed(2);
    $('#subtotal'+idx).html(subtotalFinal);

  calcularTotales();
  }

function setDescuento(event, obj, idx){
    event.preventDefault();
    var desc = document.getElementById("descuento"+idx).value;
    var desc_n = parseInt(desc);
     if(desc_n>200){
      Swal.fire('Error!, Ha excedido el limite de descuento autorizado','','error')
      document.getElementById("descuento"+idx).value="";
      document.getElementById("descuento"+idx).style.border='solid 1px red';
     }else if(desc_n<=50){
    detalles[idx].descuento = parseFloat(obj.value);
    document.getElementById("descuento"+idx).style.border='solid 1px green';
    recalcular(idx);
  }
}

function calcularTotales() {
  var total_final=0;
  for(var i=0;i<detalles.length;i++){
    total_final=total_final+detalles[i].subtotal;
  }
  $('#total_venta').html(total_final.toFixed(2));
  console.log(total_final);
}

function eliminarFila(index) {
  $("#fila" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  detalles.splice(position_element, 1);
  //recalcular(position_element);
  calcularTotales();

}

$(document).on("click","#select_paciente_venta", function(){
  var consulta = $("#consulta_ex").val();
  var tipo_venta = $("#tipo_venta").val();
  
  if(tipo_venta != "Credito Fiscal"){
    if(consulta==''){
    setTimeout ("Swal.fire('Hay campos sin seleccionar','','error')", 100);
    document.getElementById("consulta_ex").style.border='solid 1px red';
  }else if(consulta=='Si'){
    $("#modal_pacientes_consulta").modal("show");
    listar_pacientes_consultas_ventas();
  }else if(consulta=='No'){
    $("#pacientes_sin_consulta").modal("show");
    listar_pacientes_sin_consultas_ventas();
  }

}else{

  show_pacientes_empresas();
}

});

//////////////////LISTAR PACIENTES CON CONSULTAS EN VENTAS

function listar_pacientes_consultas_ventas(){
  var sucursal = $("#sucursal").val();
  tabla_paciente_venta= $('#data_pacientes_consulta').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],

    "ajax":{
      url:"ajax/pacientes.php?op=listar_pacientes_consulta",
      type : "POST",
      //dataType : "json",
      data:{sucursal:sucursal},           
      error: function(e){
      console.log(e.responseText);
    },           
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
       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
       
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

         }, //cerrando language

          //"scrollX": true

        });
}

//////////////////LISTAR PACIENTES SIN CONSULTAS EN VENTAS

function listar_pacientes_sin_consultas_ventas(){
  var sucursal = $("#sucursal").val();
  tabla_paciente_no_consulta= $('#data_pacientes_sin_consulta').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],

    "ajax":{
      url:"ajax/pacientes.php?op=listar_pacientes_sin_consulta",
      type : "POST",
      //dataType : "json",
      data:{sucursal:sucursal},           
      error: function(e){
      console.log(e.responseText);
    },           
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
       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
       
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

         }, //cerrando language

          //"scrollX": true

    });
}

///////////////////SHOW CONTRIBUYENTES 
function show_pacientes_empresas(){
  $("#contribuyente_credito_fiscal").modal("show");
    tabla_contribuyentes= $('#data_contribuyentes_fisc').DataTable({      
    "aProcessing": true,//Activamos el procesamiento del datatables
    "aServerSide": true,//Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons: [              
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],

    "ajax":{
      url:"ajax/empresas.php?op=listar_contribuyentes",
      type : "get",
      dataType : "json",
      //data:{sucursal:sucursal},           
      error: function(e){
      console.log(e.responseText);
    },           
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
       
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
       
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
       
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

         }, //cerrando language

          //"scrollX": true

        });

}



function saveVenta(){
  var tipo_pago = $("#tipo_pago").val();
  var tipo_venta = $("#tipo_venta").val();

  if (tipo_venta=="Contado") {
     registrarVenta();
    //$('#recibo_inicial').modal('show');
    //setTimeout ("mostrar_recibo_inicial();", 2000);
  }else if(tipo_venta=="Credito" && tipo_pago=="Descuento en Planilla"){
    $("#oid").modal("show");
    let id_paciente = $("#id_paciente").val();
    $.ajax({
    url:"ajax/ventas.php?op=show_datos_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    console.log(data);   
      $("#paciente_empresarial").val(data.nombres);
      $("#edad_pac").val(data.edad);
      $("#tel_pac").val(data.telefono);
    }
  })
  }
}

/**************************************************************************
***************************  INICIO REGISTRAR VENTAS  *********************
**************************************************************************/
function registrarVenta(){

  var fecha_venta = $("#fecha").val();
  var numero_venta = $("#n_venta").val();
  var paciente = $("#titular_cuenta").val();
  var vendedor = $("#usuario").val();
  var monto_total = $("#total_venta").html();
  var tipo_pago = $("#tipo_pago").val();
  var tipo_venta = $("#tipo_venta").val();
  var id_usuario = $("#usuario").val();
  var id_paciente = $("#id_paciente").val();
  var sucursal = $("#sucursal").val();
  var evaluado = $("#evaluado").val();
  var optometra = $("#optometra").val();
  var plazo = $("#plazo").val();
  var id_ref = $("#id_refererido").val();

  //if (tipo_venta=="Credito Fiscal") {}

  if (tipo_venta == "Credito" && plazo =="0") {
    setTimeout ("Swal.fire('Debe seleccionar el plazo','','error')", 100);
    return false;
  }

  var test_array = detalles.length;
  if (test_array<1) {
  Swal.fire('Debe Agregar Productos a la Venta!','','error')
  return false;
}
//VALIDAMOS EL TIPO DE VENTA

/*****SI VENTA ES CONTADO****/

if (paciente !="" && tipo_pago !=""  && tipo_venta !="") {
  $('#listar_det_ventas').html('');
   document.getElementById("btn_de_compra").style.display = "none";

    $.ajax({
    url:"ajax/ventas.php?op=registrar_venta",
    method:"POST",
    data:{'arrayVenta':JSON.stringify(detalles),'fecha_venta':fecha_venta,'numero_venta':numero_venta,'paciente':paciente,'vendedor':vendedor,'monto_total':monto_total,'tipo_pago':tipo_pago,'tipo_venta':tipo_venta,'id_usuario':id_usuario,'id_paciente':id_paciente,'sucursal':sucursal,'evaluado':evaluado,'optometra':optometra,'plazo':plazo,"id_ref":id_ref},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    console.log(data);
    //return false;       
    detalles = [];
    if(data == "error"){
      Swal.fire('La venta no se pudo realizar por que el correlativo ya fue registrado... Intentar actualizar el navegador!','','error')
      setTimeout("$('#recibo_inicial').modal('hide');",3000)
      ocultar_btn_post_venta();
    }
    }

    });//////FIN AJAX
    
    if (tipo_venta=="Contado") {       
      setTimeout ("reciboInicial();", 2500);
      mostrar_btn_post_venta();        
    }else if(tipo_venta == "Credito" && tipo_pago == "Descuento en Planilla"){
      Swal.fire('OID Registrada a la espera de Aprobación...','','info')
    }
}else{
  Swal.fire('Existen campos obligatorios vacios!','','error')
}

}

/**************************************************************************
=============================  FIN REGISTRAR VENTAS =======================
**************************************************************************/

function desc_planilla(){
  
}


function reciboInicial(){
  $('#recibo_inicial').modal('show');
  var numero_venta = $("#n_venta").val();
  var id_paciente = $("#id_paciente").val();
  var evaluado = $("#evaluado").val();
  var titular_cuenta = $("#titular_cuenta").val();
  var monto_total = $("#total_venta").html();


  $("#n_venta_recibo_ini").val(numero_venta);
  $("#id_pac_ini").val(id_paciente);
  $("#servicio_rec_ini").val(evaluado);
  $("#recibi_rec_ini").val(titular_cuenta);
  $("#monto_venta_rec_ini").val(monto_total);


  $.ajax({
  url:"ajax/ventas.php?op=get_datos_lentes_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  {

    console.log(data);  
    $("#lente_rec_ini").val(data.producto);
  }
  })
  ////////////////photo
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_photo_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#photo_rec_ini").val(data.producto);
  }
  })

    ////////////////antireflejante
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_ar_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#ar_rec_ini").val(data.producto);
  }
  })
      ////////////////aros
  $.ajax({
  url:"ajax/ventas.php?op=get_datos_aros_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#marca_aro_ini").val(data.marca);
    $("#modelo_aro_ini").val(data.modelo);
    $("#color_aro_ini").val(data.color);
  }
  })
//////////////DATOS PACIENTE
  $.ajax({
  url:"ajax/pacientes.php?op=datos_pacientes_rec_ini",
  method:"POST",
  data:{id_paciente:id_paciente},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#telefono_ini").val(data.telefono);
    $("#empresa_ini").val(data.empresas);
  }
  })

  
}///////////FIN FUNCION RECIBO INICIAL
///////////////////LISTADO GENERAL DE VENTAS
function reporte_ventas_gral(){
  var sucursal = $("#sucursal").val();
  tabla_ventas_gral=$('#lista_reporte_ventas_data').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/ventas.php?op=listar_ventas_gral',
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


function detalleVentas(numero_venta,id_paciente){
//console.log(numero_venta+id_paciente);
    $.ajax({
      url:"ajax/ventas.php?op=ver_detalle_venta",
      method:"POST",
      data:{numero_venta:numero_venta,id_paciente:id_paciente},
      cache:false,
      //dataType:"json",
      success:function(data)
      {       
        $("#tabla_detalle_venta").html(data);
   
      }
    })

}


/////////////////AGREGA DATA CONTRIBUYENTES
function contribuyenteData(id_paciente,empresa){  

  $('#contribuyente_credito_fiscal').modal('hide');
  $('#id_paciente').val(id_paciente);
  $('#id_consulta').val("");
  $('#empresa_fisc').val(empresa);
  document.getElementById("paciente_evaluado_c").style.display = "none";  

    $.ajax({
      url:"ajax/pacientes.php?op=buscar_data_pacientes_sin_consulta_ventas",
      method:"POST",
      data:{id_paciente:id_paciente},
      dataType:"json",
      success:function(data){
      console.log(data);//return false;       
        
        $("#titular_cuenta").val(data.nombres);
        $("#evaluado").val("");
        $("#codigo_paciente").val(data.codigo);
        
      }
    })
}


/////////////COMPROBAR EL TIPO DE VENTA
$(document).on('click', '.enviar_venta', function(){
  var n_venta =$("#n_venta").val();
  var id_paciente =$("#id_paciente").val();
  var empresa_fisc = $("#empresa_fisc").val();
  var tipo_venta = $("#tipo_venta").val();
console.log(tipo_venta);
if (tipo_venta=="Credito Fiscal"){
  document.getElementById("credito_fiscal_print").href='imprimir_credito_fiscal_pdf.php?empresa='+empresa_fisc+'&'+'id_paciente='+id_paciente+'&'+'n_venta='+n_venta;
}
 
});
init();