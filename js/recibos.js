var tabla_recibos_emitidos;
var tabla_cobros;
function init(){
   get_correlativo_recibo();
    //prueba();
    listar_recibos_emitidos();

    get_correlativo_orden_cobro();
    get_ordenes_cobro();

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


//==========================RECIBOS POR LOTES =============================//
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

    let plazo = data.plazo;
    let monto = data.monto;

    let monto_abono = monto/plazo;

    let obj = {
      plazo :data.plazo,
      id_paciente : data.id_paciente,      
      pacientes : data.nombres,
      evaluado : data.evaluado,
      empresa : data.empresas,
      monto : data.monto,
      saldo : data.saldo,
      subtotal : 0,
      abono_act : monto_abono.toFixed(2),
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

    data_credito_oid.sort((a,b)=>{
      if (a.id_paciente<b.id_paciente) {
        return -1
      }
      if (a.id_paciente>b.id_paciente) {
        return 1
      }

      return 0;
    });

    for(var i=0; i<data_credito_oid.length; i++){

      var filas = filas + "<tr id='filac"+i+"'>"+
      "<td style='text-align:center;width: 15%;' colspan='15'>"+data_credito_oid[i].pacientes+"</td>"+
      "<td style='text-align:center;width: 15%;' colspan='15'>"+data_credito_oid[i].evaluado+"</td>"+
      "<td style='text-align:center;width: 15%;' colspan='15'>"+data_credito_oid[i].empresa+"</td>"+
      "<td style='text-align:center;width: 5%;' colspan='5'>"+"$"+data_credito_oid[i].monto+"</td>"+
      "<td style='text-align:center;width: 5%;' colspan='5'>"+data_credito_oid[i].plazo+" Cuotas"+"</td>"+
      "<td style='text-align:center;width: 10%;' colspan='10'>"+"$"+data_credito_oid[i].saldo+"</td>"+
      "<td style='text-align:center;width: 10%;text-align:center' colspan='10'><input style='text-align:center' type='text' value="+data_credito_oid[i].abono_act+" class='form-control' onClick='setCantidadAbono(event, this, "+(i)+");' onKeyUp='setCantidadAbono(event, this, "+(i)+");'></td>"+
      "<td style='text-align:center;width: 10%;' colspan='10'><span id=saldo"+i+">"+"$"+data_credito_oid[i].nuevo_saldo+"</span></td>"+
      "<td style='text-align:center;width: 10%;font-size:13px;color:blue' colspan='10'><b><span id=subtotal"+i+">"+"$"+data_credito_oid[i].subtotal+"</span></b></td>"+
      "<td style='text-align:center;width: 5%' colspan='5' id=subtotal"+i+"><i class='nav-icon fas fa-times-circle fa-2x' onClick='eliminarCobro("+i+");' style='color:red'></i></td>"+"</tr>";
    }//cierre for

    $('#listar_data_oid').html(filas);
  //calcularTotales();
}


function setCantidadAbono(event, obj, idx){
  event.preventDefault();
  //console.log(data_credito_oid[idx].abono_act);
  data_credito_oid[idx].abono_act = parseFloat(obj.value);
  data_credito_oid[idx].subtotal = parseFloat(obj.value);
  console.log(data_credito_oid[idx].abono_act);
  recalcular_datos(idx);

}

function eliminarCobro(index) {
  $("#filac" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  data_credito_oid.splice(position_element, 1);
  //recalcular(position_element);
  calcularTotal();

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
  let totales_finales = parseFloat(total_final).toFixed(2);
  $("#total_abonos").html(totales_finales);

}

function get_correlativo_orden_cobro(){
  console.log("HolaCorrelativo")
  $.ajax({
  url:"ajax/recibos.php?op=get_numero_orden_cobro",
  method:"POST",
 // data:{sucursal_correlativo:sucursal_correlativo},
  cache:false,
  dataType:"json",
    success:function(data){
    console.log(data);        
    $("#correlativo_orden").html(data.correlativo);             
    }
  })

}

function saveOrdenCobro(){

  let numero_orden = $("#correlativo_orden").html();
  let usuario = $("#usuario").val();
  let id_usuario = $("#id_usuario").val();
  let empresa =$("#empresa_act_oid").html();
  let monto_total = $("#total_abonos").html();
  let sucursal 

  let length_data_oid = data_credito_oid.length;

  if (length_data_oid<1) {
    Swal.fire('Orden de cobro vacio!','','error')
    return false;
  }

  for(var i=0;i<data_credito_oid.length;i++){
    let currentSubt= data_credito_oid[i].subtotal;

    let saldo_actual  = data_credito_oid[i].saldo;
    let abono_actual  = data_credito_oid[i].abono_act;

    if (saldo_actual<abono_actual) {
      Swal.fire('El abono no debe ser mayor al saldo!','','error');
      return false;
    }

    if(currentSubt==0) {
      Swal.fire('Existe un item que no ha sido verificado!','','error');
      return false;
    }
  }
 
  $.ajax({
    url:"ajax/recibos.php?op=registrar_orden_cobro",
    method:"POST",
    data:{'arrayOrdenCobro':JSON.stringify(data_credito_oid),'numero_orden':numero_orden,'usuario':usuario,'id_usuario':id_usuario,'empresa':empresa,'monto_total':monto_total},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },
    success:function(data){
      console.log(data);
      if(data=='ok'){
        setTimeout ("Swal.fire('Orden de cobro creada Existosamente','','success')", 100);
        data_credito_oid = [];
        listar_data_oid();
        console.log(empresa);
        document.getElementById("totales_oid").style.display = "none";
        document.getElementById("reporte_orden_cobro").href = 'imprimir_orden_cobro.php?numero_orden='+numero_orden+'&'+'empresa='+empresa;    
      }else{
        setTimeout ("Swal.fire('Correlativo Duplicado','','error')", 100);
      }
    }

  })///Fin ajax

}


function get_ordenes_cobro(){

  tabla_cobros = $('#data_ordenes_cobro').dataTable({
    "aProcessing": true,
      "aServerSide": true,
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5'
      ],
      "ajax":
      {
        url: 'ajax/recibos.php?op=listar_ordenes_cobro',
        type : "post",
        dataType : "json",
       // data:{empresa:empresa},
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

var items_pacientes_cobro = [];
var items_ok =[];
function showDetallesOc(id_orden,numero_orden,empresa){
  items_pacientes_cobro = [];
  items_ok = [];
  $("#modal_ordenes_cobro").modal("show");

    $("#empresa_oc").html(empresa);
    $("#n_o").html(numero_orden);
    $.ajax({
    url: "ajax/recibos.php?op=get_detalle_pacientes_oc",
    method : "POST",
    data: {empresa:empresa,numero_orden:numero_orden},
    cache : false,
    dataType : "json",
    success:function(data){
    console.log(data);
    for(var i in data){
      var obj = {
        empresas: data[i].empresas,
        monto_abono: data[i].monto_abono,
        nombres: data[i].nombres,
        numero_orden: data[i].numero_orden,
        numero_recibo: data[i].numero_recibo,
        numero_venta: data[i].numero_venta,
        estado: 0,
        comprobante : 0,
        id_paciente : data[i].id_paciente
      };
      items_pacientes_cobro.push(obj);
    }

    listar_pacientes_cobro();
}

})

}

function listar_pacientes_cobro(){

  $('#confirma_orden_cobro').html('');

  for(var i=0; i<items_pacientes_cobro.length; i++){
    var filas = filas + "<tr id='fila"+i+"'><td style='text-align:center;width: 5%' colspan='5'>"+(i+1)+"</td>"+
    "<td style='text-align:center;width: 35%' colspan='35'>"+items_pacientes_cobro[i].nombres+
    "<td style='text-align:center;width: 15%' colspan='15'>"+"<div class='input-group'><div class='input-group-prepend' style='margin:0px !important;padding:0px !important'><span class='input-group-text' id='basic-addon3'style='margin:0px !important;padding:0px !important'>$</span></div>"+
    "<input type='text' class='form-control' value='"+items_pacientes_cobro[i].monto_abono+"' style='text-align:center'></div></div</td>"+
    "<td style='text-align:center;width: 15%' colspan='15'>"+items_pacientes_cobro[i].numero_recibo+"</td>"+
    "<td style='text-align:center;width: 15%' colspan='15'>"+"<input class='hemograma' type='checkbox' name='check_box' value='hemograma' id=item_oc"+i+" onClick='item_check_oc(event, this, "+(i)+");'></td>"+
    "<td style='text-align:center;width: 15%' colspan='15'><input type='text' class='form-control' onClick='setComprobante(event, this, "+(i)+");' onKeyUp='setComprobante(event, this, "+(i)+");' id=comprobante"+i+"></td></tr>";

  }

    $('#confirma_orden_cobro').html(filas);
}

function item_check_oc(event, obj, idx){ 
    var desc = document.getElementById("item_oc"+idx).value;
    let x = "item_oc"+idx;
 if (document.getElementById(x).checked){
    items_pacientes_cobro[idx].estado = "Ok";
    items_ok.push('1');
 }else{
  items_pacientes_cobro[idx].estado = "No";
  items_ok.splice(idx,1);
 }

 calcularTotalesAbonos();
}

//========================== FIN RECIBOS POR LOTES =============================//
function calcularTotalesAbonos(){
let monto_cobro = 0;
for (var i = 0; i<items_pacientes_cobro.length; i++) {
  let estado_oc = items_pacientes_cobro[i].estado;
  let monto_oc = items_pacientes_cobro[i].monto_abono;
  if (estado_oc=='Ok') {
    monto_cobro  = parseFloat(monto_cobro)+parseFloat(monto_oc);
  }
}

$("#totales_aoc").html('$'+parseFloat(monto_cobro).toFixed(2));
}

function setComprobante(event, obj, idx){
    event.preventDefault();
    items_pacientes_cobro[idx].comprobante = (obj.value);
    recalcular(idx);
  }


function guardarComprobanteOc(){

  let tipo_pago_oc = $("#tipo_pago_oc").val();
  let forma_abono = $("#forma_abono").val();
  let comprobante_oc = $("#comprobante_oc").val();
  let monto_oc = $("#totales_aoc").html();
  let id_usuario = $('#id_usuario').val();

 if(tipo_pago_oc != "0" && forma_abono != "0"){

  if (forma_abono == 'Individual'){////////////campos vacios validacion si es individual
  for (var i = 0; i<items_pacientes_cobro.length; i++) {
      let comprobante_i = 'comprobante'+i;
      let comprobante_value = document.getElementById(comprobante_i).value;
      let estado_oc = items_pacientes_cobro[i].estado;
      if (estado_oc == 'Ok' && comprobante_value == '') {
      Swal.fire('Error: Debe ingresar el comprobante a cada item !','','error');
    }
  } 
}else if(forma_abono =='Agrupado' && comprobante_oc==''){//////////Fin campos vacios validacion si es individual
  Swal.fire('Error: Debe ingresar el comprobante!','','error');
  return false;
}
/*for (var i = 0; i<items_pacientes_cobro.length; i++){
      let estado_oc = items_pacientes_cobro[i].estado;
      if (estado_oc=='Ok') {
      items_ok.push('1');
    }  
  }*/
if (items_ok.length>0) {
  console.log('Correcto!')
}else{
  Swal.fire('Error: Orden de cobro vacio!','','error');
}

//*************ENVIAR ORDEN DE COBRO A BASE DATOS *******
$.ajax({
  url:"ajax/recibos.php?op=confirmar_orden_cobro",
  method:"POST",
  data:{'arrayODC':JSON.stringify(items_pacientes_cobro),'tipo_pago_oc':tipo_pago_oc,'forma_abono':forma_abono,'comprobante_oc':comprobante_oc,'monto_oc':monto_oc,'id_usuario':id_usuario},
  cache:false,
  dataType:"json",
  success:function(data)
  {
    console.log(data);
    //$("#n_compra").val(data.num_recibo);
  }
})
//*************FIN ENVIAR ORDEN DE COBRO A BASE DATOS *******

}else{////////////Fin Campos vacios validacion
  Swal.fire('Error: Campos obligatorios vacios!','','error');return false;
}
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
//SELECT*from corte_diario where n_venta = "AVSM-244" or n_venta="AVSM-240" or n_venta="AVSM-236" or n_venta="AVSM-246" or n_venta="AVSM-229" or n_venta="AVSM-250"