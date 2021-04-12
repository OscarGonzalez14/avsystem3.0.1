var tabla_recibos_emitidos;

function init(){
   get_correlativo_recibo();
    //prueba();
    listar_recibos_emitidos();
    ocultar_btn_editar_abono();
}

////////OCULTAR BTN DE IMPRIMIR RECIBO AL INICIO
$(document).ready(ocultar_btn_print_rec_ini);

function ocultar_btn_print_rec_ini(){
  document.getElementById("btn_print_recibos").style.display = "none";
}

/////OCULTAR BOTONES RECIBOS
function ocultar_btn_editar_abono(){
  document.getElementById("edit_abono").style.display = "none";
}
function hidden_btn_guardar(){
  document.getElementById("registrar_abono").style.display = "none";
}
function show_btn_editar_abono(){
  document.getElementById("edit_abono").style.display = "block";
}
function show_btn_guardar(){
  document.getElementById("registrar_abono").style.display = "block";
}

//////// AL DAR IMPRIMIR EN LISTA DE RECIBOS 
/*$(document).on('click', '.imprimir_recibo', function(){ 
  document.getElementById("btns_orden").style.display = "none";
});
*/

/*function prueba(){
 $("#field_1").html("Holaaaaaaaaa"); 
}
*/
function get_correlativo_recibo(){
  var sucursal_correlativo = $("#sucursal").val();
  $.ajax({
    url:"ajax/recibos.php?op=get_numero_recibo",
    method:"POST",
    data:{sucursal_correlativo:sucursal_correlativo},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data); 
      console.log("Este es el correlativo de Recibo "+data.correlativo)       
      $("#n_recibo").html(data.correlativo);             
      }
    })
}

function registra_abono_inicial(){
  var fecha_rec_ini=$("#proxi_abono").val();
  var saldo=$("#saldo").val();
  var monto = $("#numero").val();

  if (monto !="" && saldo>=0) {//VALIDA MONTO
     if (saldo >0 && fecha_rec_ini=="") {
     Swal.fire('Especifique fecha de proximo abono abono!','','error')
    }else{
    //////////////SE ENVIA RECIBO
      save_abono_inicial();
    }
  }else{
    Swal.fire('Debe llenar los campos obligatorios correctamente!','','error')
  }//VALIDA MONTO
  
}

function save_abono_inicial(){

   console.log("ProofV1")
    var pr_abono=$("#proxi_abono").val();

    var a_anteriores="0";
    var n_recibo = $("#n_recibo").html();
    var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
    var monto =$("#total_venta").html();
    var fecha =$("#fecha").val();
    var sucursal =$("#sucursal").val();
    var id_paciente =$("#id_paciente").val();
    var id_usuario =$("#usuario").val();
    var telefono_ini =$("#telefono_ini").val();
    var recibi_rec_ini =$("#recibi_rec_ini").val();
    var empresa_ini =$("#empresa_ini").val();
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
    
    var servicio_rec_ini=$("#servicio_rec_ini").val();    
    
    if (forma_pago !="") {

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
        Swal.fire('Recibo registrado exitosamente!','','success');
        $('#creditos_de_contado').DataTable().ajax.reload();
      }      
    }

  });
  }else{
    Swal.fire('Especifique la forma de Pago!','','error')
    return false;
  }  
    
  }



$(document).on('click', '#btn_enviar_ini', function(){
  var n_recibo = $("#n_recibo").html();
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();
  var sucursal = $("#sucursal").val();

  document.getElementById("btn_print_recibo").href='imprimir_recibo_pdf.php?n_recibo='+n_recibo+'&'+'n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente+'&'+'sucursal='+sucursal;
    
});
/////////////IMPRIME FACTURA DE CONTADO
$(document).on('click', '#btn_enviar_ini', function(){
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();
  var empresa_fisc = $("#empresa_fisc").val();
  var tipo_venta = $("#tipo_venta").val();
  
console.log(tipo_venta);
if (tipo_venta=="Credito Fiscal"){
  document.getElementById("credito_fiscal_print").href='imprimir_c_fiscal_pdf.php?n_venta='+empresa_fisc+'&'+'id_paciente='+id_paciente;
}
  comprobarSaldo();  
  document.getElementById("btn_print_recibo").style.display = "block";
  //document.getElementById("factura_contado").href='imprimir_factura_pdf.php?n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente;  

});

function comprobarSaldo(){
  var n_venta =$("#n_venta").val();
  var id_paciente =$("#id_paciente").val();

  $.ajax({
  url:"ajax/recibos.php?op=consultar_saldo",
  method:"POST",
  data:{n_venta:n_venta,id_paciente:id_paciente},
  cache: false,
  dataType:"json",
  error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
  }, 
      
    success:function(data){
      console.log("El saldo es: "+data.saldo);
      //return false;
      saldo= data.saldo;
      if(saldo=='0'){
      document.getElementById("print_factura").style.display = "block";
      }else if (saldo>0) {
       document.getElementById("print_factura").style.display = "none";
      }
      
    }

  });

}

/////////LISTAR RECIBOS EMITIDOS
function listar_recibos_emitidos(){
  var sucursal= $("#sucursal").val();

  tabla_recibos_emitidos=$('#recibos_emitidos').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/recibos.php?op=listar_recibos_emitidos',
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

///////////////EDITAR RECIBO
function editar_recibo(){
  show_btn_editar_abono();
  hidden_btn_guardar();
  $('.modal-header').text("EDITAR RECIBOS&nbsp; & &nbsp;ABONOS#");
  var element= document.getElementById("head_abonosg");
    element.classList.add("bg-secondary");

    var elements= document.getElementById("edit_abono");
    elements.classList.add("bg-success");
}

function destroy_edits(){
  explode();
}


function show_datos_recibo(id_paciente,id_credito,numero_venta){
  $("#modal_recibos_generico").modal("show");
  get_correlativo_recibo();

  $.ajax({
    url:"ajax/recibos.php?op=show_datos_recibo",
    method:"POST",
    data:{id_paciente:id_paciente,id_credito:id_credito,numero_venta:numero_venta},
    cache:false,
    dataType:"json",
    success:function(data)
    { 
      console.log(data); 
    $("#recibi_abono").val(data.recibi_de);
    $("#servicio_abono").val(data.servicio_para);
    $("#telefono_abono").val(data.telefono);
    $("#empresa_abono").val(data.empresa);
    $("#texto").val(data.cant_letras);
    $("#pr_abono_ini").val(data.pr_abono_ini);
    $("#monto_venta_rec_ini").val(data.monto);
    $("#abono_ant").val(data.abono_ant);
    $("#saldo_credito").val(data.saldo_credito);
    $("#numero").val(data.numero);
    $("#saldo").val(data.saldo);
    $("#forma_pago").val(data.forma_pago);
    $("#pr_abono").val(data.prox_abono);
    $("#marca_aro_ini").val(data.marca_aro);
    $("#modelo_aro_ini").val(data.modelo_aro);
    $("#color_aro_ini").val(data.color_aro);
    $("#lente_rec_ini").val(data.lente);
    $("#photo_rec_ini").val(data.photo);    
    $("#ar_rec_ini").val(data.anti_r);
    $("#observaciones_rec_ini").val(data.observaciones);
    $("#id_pac_ini").val(data.id_paciente);
    $("#n_venta_recibo_ini").val(data.numero_venta);

  }

})

}

init();