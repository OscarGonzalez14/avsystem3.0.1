function init(){
	listar_creditos_sucursal();
  listar_creditos_cauto();

}
///////////OCULTAR ELEMENTOS AL INICIO
$(document).ready(ocultar_element_ini);

  function ocultar_element_ini(){
  document.getElementById("print_orden_desp").style.display = "none";
  document.getElementById("btn_print_recibos").style.display = "none";

}
////////////////LISTAR CREDITOS DE CONTADO
function listar_creditos_sucursal(){
  var sucursal= $("#sucursal").val();
  tabla_creditos_sucursal=$('#creditos_de_contado').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/creditos.php?op=listar_creditos_contado',
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
///////////////LISTAR CREDITOS DE CARGO AUTOMATICO
function listar_creditos_cauto(){
  var sucursal= $("#sucursal").val();
  tabla_creditos_cauto=$('#creditos_cauto').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/creditos.php?op=listar_creditos_cauto',
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

///////////////LISTAR CREDITOS DESCUENTO EN PLANILLA
function listar_creditos_oid(){
  var sucursal= $("#sucursal").val();
  var empresa= $("#empresa").val();

  tabla_creditos_oid=$('#creditos_oid').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/creditos.php?op=listar_creditos_oid',
          type : "post",
          dataType : "json",
          data:{sucursal:sucursal,empresa:empresa},
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


//////////////RECIBOS Y ABONOS
function realizarAbonos(id_paciente,id_credito,numero_venta){
  $("#modal_recibos_generico").modal("show");
  //$("#numero").val("");
   // document.getElementById("numero").focus();
  ////////ajax datos de paciente
  $.ajax({
  url:"ajax/creditos.php?op=datos_paciente_abono",
  method:"POST",
  data:{id_paciente:id_paciente,id_credito:id_credito,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);

    var nuevo_saldo = data.saldo-data.cuotas;  
    $("#recibi_abono").val(data.paciente);
    $("#servicio_abono").val(data.evaluado);
    $("#telefono_abono").val(data.telefono);
    $("#empresa_abono").val(data.empresas);
    $("#monto_venta_rec_ini").val(data.monto);
    $("#n_venta_recibo_ini").val(data.numero_venta);
    $("#id_paciente").val(data.id_paciente);
    $("#saldo_credito").val(data.saldo);
    $("#saldo").val(nuevo_saldo.toFixed(2));
    $("#numero").val(data.cuotas); 
    
 }
  })
 //////// FIN ajax datos de paciente
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

    ////////////////abono anterior
  $.ajax({
  url:"ajax/creditos.php?op=datos_abono_anterior",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#abono_ant").val(data.monto_abono);
  }
  })
}

////////////////REGISTRAR ABONO
function registra_abonos(){
  var fecha_rec_ini=$("#pr_abono").val();
  var saldo=$("#saldo").val();
  var monto = $("#numero").val();

  if (monto !="" && saldo>=0) {//VALIDA MONTO
     if (saldo >0 && fecha_rec_ini=="") {
     Swal.fire('Especifique fecha de proximo abono abono!','','error')
    }else{
    //////////////SE ENVIA RECIBO
      registrar_abono();
    }
  }else{
    Swal.fire('Debe llenar los campos obligatorios correctamente!','','error')

  }//VALIDA MONTO
  
}

function registrar_abono(){

    var a_anteriores=$("#abono_ant").val();
    var n_recibo = $("#n_recibo").html();
    var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
    var monto =$("#monto_venta_rec_ini").val();
    var fecha =$("#fecha").val();
    var sucursal =$("#sucursal").val();
    var id_paciente =$("#id_paciente").val();
    var id_usuario =$("#usuario").val();
    var telefono_ini =$("#telefono_abono").val();
    var recibi_rec_ini =$("#recibi_abono").val();
    var empresa_ini =$("#empresa_abono").val();
    var texto=$("#texto").val();
    var numero=$("#numero").val();
    var saldo=$("#saldo").val();
    var forma_pago=$("#forma_pago").val();
    var marca_aro_ini=$("#marca_aro_ini").val();
    var modelo_aro_ini=$("#modelo_aro_ini").val();    
    var color_aro_ini=$("#color_aro_ini").val();
    var lente_rec_ini=$("#lente_rec_ini").val();
    var ar_rec_ini=$("#ar_rec_ini").val();
    var photo_rec_ini=$("#photo_rec_ini").val();
    var observaciones_rec_ini=$("#observaciones_rec_ini").val();
    var pr_abono=$("#pr_abono").val();
    var servicio_rec_ini=$("#servicio_abono").val();    
    
    if (forma_pago !="") {
    $('#creditos_de_contado').DataTable().ajax.reload();
    $.ajax({
    url:"ajax/recibos.php?op=registrar_recibo",
    method:"POST",
    data:{a_anteriores:a_anteriores,n_recibo:n_recibo,n_venta_recibo_ini:n_venta_recibo_ini,monto:monto,fecha:fecha,sucursal:sucursal,id_paciente:id_paciente,id_usuario:id_usuario,telefono_ini:telefono_ini,recibi_rec_ini:recibi_rec_ini,empresa_ini:empresa_ini,texto:texto,numero:numero,saldo:saldo,forma_pago:forma_pago,marca_aro_ini:marca_aro_ini,modelo_aro_ini:modelo_aro_ini,color_aro_ini:color_aro_ini,lente_rec_ini:lente_rec_ini,ar_rec_ini:ar_rec_ini,photo_rec_ini:photo_rec_ini,observaciones_rec_ini:observaciones_rec_ini,pr_abono:pr_abono,servicio_rec_ini:servicio_rec_ini},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    }, 
      
    success:function(data){
      console.log(data);
      if(data=='error'){
        Swal.fire('Este correlativo ya fué ingresado!','','error')
        return false;
      }else if (data=="ok") {
        Swal.fire('Recibo registrado exitosamente!','','success')
        //$('#recibo_inicial').modal('hide');
        //setTimeout ("explode();", 2000);
      }
      
    }

  });
  }else{
    Swal.fire('Especifique la forma de Pago!','','error')
    return false;
  }  
    
  }
  ///////////////////////IMPRIMIR RECIBO DE ABONO
  $(document).on('click', '#registrar_abono', function(){
  var n_recibo = $("#n_recibo").html();
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();
  document.getElementById("btn_print_recibos").style.display = "block";
  let sucursal = $("#sucursal").val();

  document.getElementById("btn_print_recibos").href='imprimir_recibo_pdf.php?n_recibo='+
  n_recibo+'&'+'n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal;
  
});
  /////////////////LISTAR DETALLE DE ABONOS
  function verDetAbonos(id_paciente,numero_venta){
  $("#detalle_abonos").modal("show");
  tabla_det_abono=$('#lista_det_abonos').dataTable({
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Brtip',//Definimos los elementos del control de tabla
       buttons: [
                'excelHtml5'
            ],
    "ajax":
        {
          url: 'ajax/creditos.php?op=listar_detalle_abonos',
          type : "post",
          //dataType : "json",
          data:{id_paciente:id_paciente,numero_venta:numero_venta},
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

//////////////////////////////GET DATOS PACENTE CREDITO

  $.ajax({
  url:"ajax/creditos.php?op=get_datos_credito_abono",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#paciente_det_abono").html(data.nombres);
    $("#monto_det_abono").html(data.monto);
    $("#total_abonado").html(data.abonado);
    $("#saldo_det_abono").html(data.saldo);
  }
  })

}

////////////////GET CREDITOS POR CATEGORÍA
$(document).on('click', '.cat_creditos', function(){
  var categoria = $(this).attr("name");
  if (categoria == "cat_b") {
    $("#name_cat").html("CATEGORIA B");
  }else if(categoria == "cat_c"){
    $("#name_cat").html("CATEGORIA C");
  }

  tabla_cats_creditos=$('#cats_creditos').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                { extend: 'excelHtml5', footer: true }
            ],
    "ajax":
        {
          url: 'ajax/creditos.php?op=show_cat_creditos',
          type : "post",
          dataType : "json",
          data:{categoria:categoria},
          error: function(e){
            console.log(e.responseText);
          }
        },
         drawCallback: function () {
        var monto_saldo = $('#cats_creditos').DataTable().column(4).data().sum();
        $('#montos_c').html('$'+monto_saldo.toFixed(2));
        var creditos = $('#cats_creditos').DataTable().column(5).data().sum();
        $('#saldo_pend').html('$'+creditos.toFixed(2));
        var abonado = $('#cats_creditos').DataTable().column(6).data().sum();
        $('#abonado').html('$'+abonado.toFixed(2));

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
  
});
////////////////GET DATOS PACIENTE CREDITOS ATRASADOS/////////////
function info_pacientes_mora(id_paciente,numero_venta){

  $.ajax({
  url:"ajax/creditos.php?op=get_datos_creditos_mora",
  method:"POST",
  data:{id_paciente:id_paciente},
  cache:false,
  dataType:"json",
  success:function(data)
  { 
    console.log(data);  
    $("#paciente_credito_mora").html(data.nombres);
    $("#tel_credito_mora").html(data.telefono);
    $("#empresa_credito_mora").html(data.empresas);
    $("#dir_credito_mora").html(data.direccion);

  }
  })
////////////////////GET DATOS VENTA CREDITO EN MORA
  $.ajax({
  url:"ajax/creditos.php?op=get_datos_venta_mora",
  method:"POST",
  data:{id_paciente:id_paciente,numero_venta:numero_venta},
  cache:false,
  dataType:"json",
  success:function(data){ 
    console.log(data);  
    $("#evaluado_credito_mora").html(data.evaluado);
    $("#fecha_credito_mora").html(data.fecha_venta);
    $("#asesor_credito_mora").html(data.usuario);
    $("#tipo_venta_mora").html(data.tipo_venta);
    $("#tipo_pago_mora").html(data.tipo_pago);

  }
  })

}

function print_facturas_ventas(){

  let id_paciente = $("#id_paciente").val();
  let numero_venta = $("#n_venta").val();

  console.log(numero_venta);
  print_invoices(id_paciente,numero_venta);
}

function print_invoices(id_paciente,numero_venta){
 // console.log(numero_venta);return false;
var sucursal = $("#sucursal").val();
var id_usuario = $("#usuario").val();
$("#id_paciente_venta_factura").val(id_paciente);
$("#print_invoices").modal("show");
$("#n_venta_factura").val(numero_venta);

  $.ajax({
    url:"ajax/creditos.php?op=get_correlativo_factura",
    method:"POST",
    data:{sucursal:sucursal},
    cache:false,
    dataType:"json",
    success:function(data){ 
      console.log(data);
 
        $("#correlativo_factura").html(data.correlativo);
        var correlativo_f = data.correlativo;
        console.log(correlativo_f);
        document.getElementById("link_invoice_print").href='imprimir_factura_pdf.php?n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'correlativo_f='+correlativo_f;
      }
  })
  
  //var enlace = document.getElementById("link_invoice_print");
  //enlace.addEventListener("click", registrar_impresion, false);
}


function registrar_impresion(){

  let sucursal = $("#sucursal").val();
  let id_usuario = $("#usuario").val();
  let correlativo_fac = $("#correlativo_factura").html();
  let numero_venta = $("#n_venta_factura").val();
  var id_paciente = $("#id_paciente_venta_factura").val();
  $("#print_invoices").modal("hide"); 
  ///////////// REGISTRA CORRELATIVO EN BD ////////////////
  $.ajax({
    url:"ajax/creditos.php?op=save_correlativo_factura",
    method:"POST",
    data:{sucursal:sucursal,numero_venta:numero_venta,id_usuario:id_usuario,correlativo_fac:correlativo_fac,id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
      console.log(data);  

    }
  })

}

///////////////REGISTRAR ORDEN DE DESCUENTO //////////////
function registra_orden_desc(){

  let nombre_paciente = $("#paciente_empresarial").val();
  if (nombre_paciente != ""){
    

   Swal.fire('Descuento en planilla Registrado a la espera de aprobación!','','info');
  }else{
    Swal.fire('Existen campos obligatorios vacios!','','error');
  }
}

init();
