function init(){
	listar_creditos_sucursal();
  listar_creditos_cauto();
  listar_ordenes_pendientes();
  listar_oid_aprobadas();

}
///////////OCULTAR ELEMENTOS AL INICIO
$(document).ready(ocultar_element_ini);

function ocultar_element_ini(){
  document.getElementById("print_orden_desp").style.display = "none";
  document.getElementById("btn_print_recibos").style.display = "none";

}

//////// AL VER DETALLES EN OID APROBADAS, OCULTAR BOTONES 
$(document).on('click', '.ocultar_btns_oid', function(){ 
  document.getElementById("btns_orden").style.display = "none";
});

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
  get_correlativo_recibo();

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

  console.log("ProoofV2")
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
          $('#creditos_de_contado').DataTable().ajax.reload();
          $('#creditos_oid').DataTable().ajax.reload();

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
    let abonado_act = data.abonado; 
    $("#paciente_det_abono").html(data.nombres);
    $("#monto_det_abono").html(data.monto);
    $("#total_abonado").html(abonado_act);
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
 var fecha_fac = $("#fecha_facturacion").val();
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
    document.getElementById("link_invoice_print").href='imprimir_factura_pdf.php?n_venta='+numero_venta+'&'+'id_paciente='+id_paciente+'&'+'correlativo_f='+correlativo_f+'&'+'fecha_fac='+fecha_fac;
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
function calculaFinCredito(){
  setTimeout ("get_finaliza();", 3000);

}
function get_finaliza(){
  let inicio = $("#fecha_inicio").val();
  let plazo_credito = $("#plazo_credito").val();
  console.log("inicioo"+inicio+plazo_credito);
  $.ajax({
    url:"ajax/creditos.php?op=get_finaliza_fecha",
    method:"POST",
    data:{inicio:inicio,plazo_credito:plazo_credito},
    cache:false,
    dataType:"json",
    success:function(data){ 
      console.log(data);  
      $("#end_credito").val(data);
    }
  })
}
    /************************************************************
    *****************ORDENES DE DESCUENTO EN PLANILLA************
    *************************************************************/
    function listar_ordenes_pendientes(){
      let sucursal = $("#sucursal").val();
      tabla_ordenes_pla = $('#ordenes_desc_pendientes').DataTable({      
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
      url:"ajax/creditos.php?op=listar_oid_pendientes",
      type : "post",
      dataType : "json",
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

  var detalle_venta_flotante = [];
  var venta_flotante = [];
  var beneficiarios_orden = [];
  
  function acciones_oid(numero_orden,id_paciente,estado){
  detalle_venta_flotante = [];
  venta_flotante = [];
  beneficiarios_orden=[]
  let categoria_usuario = $('#cat_user').val();
  //console.log(`cat ${categoria_usuario} orden ${numero_orden} id_paciente ${id_paciente} estado ${estado}`)
  $("#detalle_oid").modal("show");
  if (categoria_usuario != "administrador") {
    document.getElementById("btns_orden").style.display = "none";
  }
  /////////////ajax data detalles del  orden
  //$("#nnn").val(numero_orden)
  $.ajax({
    url:"ajax/creditos.php?op=get_detalles_orden_oid",
    method:"POST",
    data:{id_paciente:id_paciente,numero_orden:numero_orden},
    cache:false,
    dataType:"json",
    success:function(data){ 
     // console.log(data);  
      $("#monto_orden").html(data.monto);
      $("#plazo_orden").html(`${data.plazo} cuotas`);
      $("#cuota_orden").html(data.cuota);
      $("#ref1_orden").html(data.referencia_uno);
      $("#ref2_orden").html(data.referencia_dos);
      $("#total_orden_t").html(data.monto);
      $("#plazo_orden_desc").val(data.plazo);
      $("#n_orden_des").val(numero_orden);
    }
  })


  $.ajax({
    url:"ajax/creditos.php?op=get_detalles_orden_paciente",
    method:"POST",
    data:{id_paciente:id_paciente},
    cache:false,
    dataType:"json",
    success:function(data){ 
    //  console.log(data);  
      $("#paciente_orden").html(data.nombres);
      $("#funcion_pac_orden").html(data.ocupacion);
      $("#dui_pac_orden").html(data.dui);
      $("#edad_pac_orden").html(`${data.edad} años`);
      $("#nit_pac_orden").html(data.nit);
      $("#tel_pac_orden").html(data.telefono);
      $("#tel_of_pac_orden").html(data.telefono_oficina);
      $("#correo_pac_orden").html(data.correo);
      $("#dir_pac_orden").html(data.direccion);
      $("#empresa_pac_orden").html(data.empresas);
    }
  })

  ///////////////////////GET DATA BENEFICIARIOS //////////////////
  $.ajax({
    url : "ajax/creditos.php?op=get_beneficiarios",
    method :"POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
    console.log(data);  

    for(var i in data){
    var obj = {
      numero_orden : data[i].numero_orden,
      nombres : data[i].nombres,
      empresas : data[i].empresas,
      id_paciente : data[i].id_paciente,
      estado : data[i].estado,
      id_orden : data[i].id_orden,
      sucursal : data[i].sucursal,
      evaluado : data[i].evaluado,
      monto_total : data[i].monto_total,
      plazo : data[i].plazo
    };//FIN OBJ
      beneficiarios_orden.push(obj);
     // console.log(beneficiarios_orden);
      detalle_beneficiarios_orden();
    }//Fin for
    

    }
  })

  var total = 0
  ////////////////GET DETALLE PRODUCTOS ORDEN
  $.ajax({
    url : "ajax/creditos.php?op=get_detalle_productos_orden",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
      //console.log(data);

    for(var i in data){
     //var total = parseInt(total) + parseInt(data[i].precio_final);
     var obj = {
      id_producto : data[i].id_producto,
      cantidad : data[i].cantidad,
      producto : data[i].producto,
      precio_venta : data[i].precio_venta,
      descuento : data[i].descuento,
      precio_final : data[i].precio_final,
      descuento : data[i].descuento,
      fecha_venta : data[i].fecha_venta,
      id_usuario : data[i].id_usuario,
      id_paciente : data[i].id_paciente,
      beneficiario : data[i].beneficiario,
      categoria_ub : data[i].categoria_ub
      };//FIN OBJ
      detalle_venta_flotante.push(obj);
      detalle_productos_flotantes();

    }

  }
})

  $.ajax({
    url: "ajax/creditos.php?op=get_detalle_venta_flotante",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
     // console.log(data);
      for(var i in data){
        var obj_dos = {
         fecha_venta : data[i].fecha_venta,
         paciente: data[i].paciente,
         vendedor: data[i].vendedor,
         monto_total: data[i].monto_total,
         tipo_pago: data[i].tipo_pago,
         tipo_venta: data[i].tipo_venta,
         id_usuario: data[i].id_usuario,
         id_paciente: data[i].id_paciente,
         sucursal: data[i].sucursal,
         evaluado: data[i].evaluado,
         optometra: data[i].optometra
      }; //Fin obj_dos
      venta_flotante.push(obj_dos);
    }

  }
})

////////////////////////////GET BENEFIACIOS EN VENTAS FLOTANTES PARA DETALLE VENTAS FLOTANTES ///////////////
  $.ajax({
    url: "ajax/creditos.php?op=get_beneficiarios_ventas_flot",
    method : "POST",
    data: {id_paciente:id_paciente,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
      for(var i in data){
      console.log(data[i].evaluado)
      let flotante_benf = data[i].evaluado;
      let flotante_b = flotante_benf.toString();
       console.log(flotante_b);
       console.log(numero_orden);
       console.log(id_paciente);
       get_det_f_ben(id_paciente,numero_orden,flotante_b);
      //GET DETALLE DE VENTA FLOTANTE POR PACIENTE      
////FIN DETALLE DE VENTA FLOTANTE POR PACIENTE
}; //Fin GET VENTAS FLOTANTES ASOCIADOS A LA ORDEN
}

})
 //listar_beneficiarios_productos();
}



function get_det_f_ben(id_paciente,numero_orden){

  console.log(`Este es el ID: ${id_paciente} Este es # orden ${numero_orden}`);
 
   $.ajax({
      url:"ajax/creditos.php?op=get_det_ventas_flotantes",
      method:"POST",
      data:{numero_orden:numero_orden,id_paciente:id_paciente},
      cache:false,
      //dataType:"json",
      success:function(data)
      { 
        console.log(data)      
        $("#beneficiarios_productos_vf").html(data);
   
      }
    })

}


function listar_beneficiarios_productos(){

  $('#beneficiarios_productos_vf').html('');
  var filas = "";
  for(var i=0; i<det_ventas_flotantes.length; i++){
   var filas = filas +"<tr>"+
      "<td style='text-align:center;width: 10% !important'>"+det_ventas_flotantes[i].cantidad_venta+"</td>"+
      "<td style='text-align:center;width: 65% !important'>"+det_ventas_flotantes[i].producto+"</td>"+
      "<td style='text-align:center;width: 15% !important'>"+"$"+det_ventas_flotantes[i].precio_final+"</td>"
      +"</tr>";
  }

  $('#beneficiarios_productos_vf').html(filas);

}

function detalle_beneficiarios_orden(){
  let monto_total = 0;
  $('#benefiaciarios_orden').html('');
  var filas = "";
  for(var i=0; i<beneficiarios_orden.length; i++){
    let est_ord = beneficiarios_orden[i].estado;
  if(est_ord=="Aprobado"){
    monto_total = parseFloat(monto_total)+parseFloat(beneficiarios_orden[i].monto_total);
    var color = "green";
  }else{
    var color = "orange";
  }

  var filas = filas + "<tr id='fila"+i+"'><td style='width: 15%;color: blue'>"+"<input class='check_beneficiarios' style='color:red' type='checkbox' name='check_beneficiarios' value='valor"+i+"' id=item"+i+" onClick='estado_check_beneficiario(event, this, "+(i)+");'></td>"+
      "<td style='text-align:center;width: 10% !important;color:"+color+"'>"+beneficiarios_orden[i].estado+"</td>"+
      "<td style='text-align:center;width: 65% !important'>"+beneficiarios_orden[i].evaluado+"</td>"+
      "<td style='text-align:center;width: 10% !important'>"+"$"+beneficiarios_orden[i].monto_total+"</td>"
      +"</td>"+
      "</tr>";
  }
  console.log("SUMMA"+monto_total)
  $('#benefiaciarios_orden').html(filas);

  for(var i=0; i<beneficiarios_orden.length; i++){
    let id_item = "item"+i;
    console.log(id_item);
    if((beneficiarios_orden[i].estado)=="Aprobado"){
       document.getElementById(id_item).checked = true;
       document.getElementById(id_item).disabled = true;
       document.getElementById(id_item).style.background  = "red"
    }
  }
}


function estado_check_beneficiario(event, obj, idx){
 
 let estado_check =  beneficiarios_orden[idx].estado;
 console.log(estado_check);

 if(estado_check=="Sin aprobar"){
  beneficiarios_orden[idx].estado = "Ok";
 }else if(estado_check=="Ok"){
  beneficiarios_orden[idx].estado = "Denegado";
 }else if(estado_check=="Denegado")
  beneficiarios_orden[idx].estado = "Ok";
}


function detalle_productos_flotantes(){ 
  $('#detalle_productos_orden').html('');
  var filas = "";
  for(var i=0; i<detalle_venta_flotante.length; i++){
    var filas = filas +"<tr id='fila"+i+"'><td style='text-align:center;width: 25% !important' colspan='25'>"+detalle_venta_flotante[i].cantidad+
    "</td>"+"<td style='text-align:center;width: 50% !important' colspan='50'>"+detalle_venta_flotante[i].producto+"</td>"+
    "<td style='text-align:center;width: 25%' colspan='25'>"+detalle_venta_flotante[i].precio_final+"</td>"+"</tr>";
  }
  $('#detalle_productos_orden').html(filas);
}


function aprobar_od_planilla(){
 let plazo = $("#plazo_orden_desc").val();
 let numero_orden = $("#n_orden_des").val();
 let sucursal = $("#sucursal").val();

 $.ajax({
  url:"ajax/creditos.php?op=aprobar_orden_planilla",
  method: "POST",
  data: {'beneficiariosArray':JSON.stringify(beneficiarios_orden),'sucursal':sucursal},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
    d_pacole.log(x);
    console.log(y);
    console.log(z);
  },     
  success:function(data){
    console.log(data);
    $('#ordenes_desc_pendientes').DataTable().ajax.reload();
  }
})
 Swal.fire('Orden de descuento registrado!','','success');
 $("#detalle_oid").modal('hide');
}


function aprobar_od_planillassss(){
 let plazo = $("#plazo_orden_desc").val();
 let numero_orden = $("#n_orden_des").val();
 $.ajax({
  url:"ajax/creditos.php?op=aprobar_orden_planilla",
  method: "POST",
  data: {'detOrden':JSON.stringify(detalle_venta_flotante),'arrayVenta':JSON.stringify(venta_flotante),'plazo':plazo,'numero_orden':numero_orden},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
    d_pacole.log(x);
    console.log(y);
    console.log(z);
  },     
  success:function(data){
    console.log(data);
    $('#ordenes_desc_pendientes').DataTable().ajax.reload();
  }
})
 Swal.fire('Orden de descuento registrado!','','success');
 $("#detalle_oid").modal('hide');
}

function denegar_od_planilla(){
  let numero_orden = $("#n_orden_des").val();

  bootbox.confirm("¿Está Seguro de denegar esta orden?", function(result){
    if(result){

      $.ajax({
        url:"ajax/creditos.php?op=denegar_orden",
        method:"POST",
        data:{numero_orden:numero_orden},
        dataType:"json",
        success:function(data)
        {
          console.log(data);
          if(data=="ok"){
            setTimeout ("Swal.fire('La orden ha sido denegada','','warning')", 100);
      }          //alert(data);
      $("#data_pacientes").DataTable().ajax.reload();
    }
  });

    }
});//bootbox

}


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


/////////LISTAR OIDS CREADAS
function listar_oid_aprobadas(){
  var sucursal= $("#sucursal").val();
  tabla_oid_creadas=$('#oid_aprobadas').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/creditos.php?op=listar_oid_aprobadas',
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

//////Eliminar oid solo para administradores


function eliminar_oid(id_orden, numero_orden, id_paciente){

  let cat_user = $("#cat_user").val();
  console.log(cat_user);
  if (cat_user=="administrador"){

    bootbox.confirm("¿Está Seguro de eliminar OID aprobada?", function(result){
      if(result){

        $.ajax({
          url:"ajax/creditos.php?op=eliminar_oid",
          method:"POST",
          data:{id_orden:id_orden,numero_orden:numero_orden,id_paciente:id_paciente},
          dataType:"json",
          success:function(data)
          {
            console.log(data);
            if(data=="ok"){
              setTimeout ("Swal.fire('OID Eliminada Existosamente','','success')", 100);
              setTimeout ("explode();", 2000);
            }
            $("#oid_aprobadas").DataTable().ajax.reload();   
          }
        });

      }
});//bootbox

  }else if (cat_user=="optometra","asesor") {
      setTimeout ("Swal.fire('No posse permisos para eliminar OID','','error')", 100);
    }
}

init();
