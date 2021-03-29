var tabla_recibos_emitidos;

function init(){
   get_correlativo_recibo();
    //prueba();
    listar_recibos_emitidos();
}

////////OCULTAR BTN DE IMPRIMIR RECIBO AL INICIO
$(document).ready(ocultar_btn_print_rec_ini);

function ocultar_btn_print_rec_ini(){
  document.getElementById("btn_print_recibos").style.display = "none";
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
      console.log("Este es el correlativo de REcibo"+data.correlativo)       
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


/////////////// GET CREDITOS PARA EMITIR POR LOTES ////////////////////////

function get_cobros_empresariales(){
  data_credito_oid  = [];
  items_oid=[];
  var empresa = $("#empresa_act_oid").html();
  console.log(empresa);
  tabla_oids = $('#lista_creditos_emp').dataTable({
    "aProcessing": true,
      "aServerSide": true,
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/recibos.php?op=listar_creditos_empresariales',
        type : "post",
        dataType : "json",
        data:{empresa:empresa},
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
var items_oid=[];

$(document).on('click', '.selectPacienteOid', function(){

  let id_pac = $(this).attr("value");
  let numero_venta = $(this).attr("name");
  let id_item = $(this).attr("id");

  console.log(`id:_paciente ${id_pac} numero_venta ${numero_venta} id_item ${id_item}`);

  let chk = document.getElementById(id_item);
  let estado_chk = chk.checked;
  console.log(estado_chk);

  if (estado_chk == true) {
    let obj = {
    id_paciente : id_pac,
    numero_venta : numero_venta
  }
  items_oid.push(obj);
  }else if(estado_chk == false){
  let index = items_oid.findIndex(x => x.venta==numero_venta)
  console.log(index)
  items_oid.splice(index, 1)
  }

});

var data_credito_oid=[];

function get_data_credito_oid(){

  //data_credito_oid=[];

  for(var i=0;i<items_oid.length;i++){
    var id_paciente = items_oid[i].id_paciente;
    var numero_venta = items_oid[i].numero_venta;

    $.ajax({
    url:"ajax/creditos.php?op=get_data_credito_oid",
    method:"POST",
    data:{numero_venta:numero_venta,id_paciente:id_paciente},
    cache: false,
    dataType:"json",
    success:function(data){
    console.log(data);

    let obj = {
      pacientes : data.nombres,
      empresa : data.empresas,
      monto : data.monto,
      saldo : data.saldo,
      subtotal : 0,
      abono_act : 0,
      numero_venta : data.numero_venta,
      nuevo_saldo :data.saldo
    }
    data_credito_oid.push(obj);
    listar_data_oid();
    } 
 
  });  

  }////////FIN DEL FOR
  $("#modalOrdenCobro").modal("hide");
 
}

function listar_data_oid(){

  $('#listar_data_oid').html('');

    var filas = "";
    //var subtotal = 0;
    var total = 0;

    for(var i=0; i<data_credito_oid.length; i++){

      var filas = filas + "<tr id='fila"+i+"'><td style='text-align:center;width: 5%;' colspan='5'>"+(i+1)+"</td>"+
      "<td style='text-align:center;width: 20%;' colspan='20'>"+data_credito_oid[i].pacientes+"</td>"+
      "<td style='text-align:center;width: 25%;' colspan='25'>"+data_credito_oid[i].empresa+"</td>"+
      "<td style='text-align:center;width: 10%;' colspan='10'>"+"$"+data_credito_oid[i].monto+"</td>"+
      "<td style='text-align:center;width: 10%;' colspan='10'>"+"$"+data_credito_oid[i].saldo+"</td>"+
      "<td style='text-align:center;width: 10%;text-align:center' colspan='10'><input style='text-align:center' type='number' value="+data_credito_oid[i].abono_act+" class='form-control' onClick='setCantidadAbono(event, this, "+(i)+");' onKeyUp='setCantidadAbono(event, this, "+(i)+");'></td>"+
      "<td style='text-align:center;width: 10%;' colspan='10'><span id=saldo"+i+">"+"$"+data_credito_oid[i].nuevo_saldo+"</span></td>"+
      "<td  style='text-align:center;width: 10%;font-size:13px;color:blue' colspan='10'><b><span id=subtotal"+i+">"+"$"+data_credito_oid[i].subtotal+"</span></b></td>"+"</tr>";
    }//cierre for
    $('#listar_data_oid').html(filas);
  //calcularTotales();
}


function setCantidadAbono(event, obj, idx){
  event.preventDefault();
  console.log(data_credito_oid[idx].abono_act);
  data_credito_oid[idx].abono_act = parseFloat(obj.value);
  console.log(data_credito_oid[idx].abono_act);
  recalcular_datos(idx);

}

function recalcular_datos(idx){
  let abono = (data_credito_oid[idx].abono_act).toFixed(2);
  let n_saldo = parseFloat(data_credito_oid[idx].saldo) - parseFloat(abono);
  let nuevo_saldo = (n_saldo).toFixed(2);
  data_credito_oid[idx].nuevo_saldo = parseFloat(nuevo_saldo);
  $("#saldo"+idx).html("$"+nuevo_saldo);
  $("#subtotal"+idx).html("$"+abono);

  calcularTotal();
}

function calcularTotal(){

  var total_final = 0;
  for (var i = 0; i < data_credito_oid.length; i++) {
    var abono = data_credito_oid[i].abono_act;
    total_final = total_final+abono;
  }
  console.log(total_final);
  $("#total_abonos").html(total_final.toFixed(2));

}

init();