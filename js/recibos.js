function init(){
   get_correlativo_recibo();
    prueba();
}

////////OCULTAR BTN DE IMPRIMIR RECIBO AL INICIO
$(document).ready(ocultar_btn_print_rec_ini);

  function ocultar_btn_print_rec_ini(){
  get_correlativo_venta();
  document.getElementById("btn_print_recibo").style.display = "none";
  document.getElementById("print_factura").style.display = "none";
  document.getElementById("credito_fiscal_print").style.display = "none";
  document.getElementById("btn_print_recibos").style.display = "none";

}

function prueba(){
 $("#field_1").html("Holaaaaaaaaa"); 
}

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
    var pr_abono=$("#proxi_abono").val();
    //alert(pr_abono);return false;
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



$(document).on('click', '#btn_enviar_ini', function(){
  var n_recibo = $("#n_recibo").html();
  var n_venta_recibo_ini =$("#n_venta_recibo_ini").val();
  var id_paciente =$("#id_paciente").val();

  document.getElementById("btn_print_recibo").href='imprimir_recibo_pdf.php?n_recibo='+
  n_recibo+'&'+'n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente;
    
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
  document.getElementById("factura_contado").href='imprimir_factura_pdf.php?n_venta='+n_venta_recibo_ini+'&'+'id_paciente='+id_paciente;  



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

init();