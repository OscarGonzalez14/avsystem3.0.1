<style>
    #tamModal_orden_desc{
      max-width: 85% !important;
    }
     #head_oid{
        background-color: black;
        color: white;
        text-align: center;
    }
    .input-dark{
      border: solid 1px black;
      border-radius: 0px;
    }
    .input-dark{
      border: solid 1px black;
    }
    .obs{
      color: red;
    }
     .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .table2 {
       border-collapse: collapse;
    }
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detalle_oid" style="border-radius:0px !important;">
  <div class="modal-dialog" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i>DETALLE ORDEN DESCUENTO EN PLANILLA #</span><span id="correlativo_orden"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
    
    <div class="card-body p-0" style="margin:7px">
  
  <table width="100%" class="table-hover table-bordered display nowrap">
    <tr class="bg-info">
    <th colspan="100" style="color:white;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DATOS GENERALES DEL PACIENTE</b></th>  
    </tr>
    <tr class="bg-light">
      <th colspan="45" style="text-align:center;font-size: 12px;width:45%;font-family: Helvetica, Arial, sans-serif"><b>NOMBRE COMPLETO</b></th>
      <th colspan="30" style="text-align:center;font-size: 12px;width:30%;font-family: Helvetica, Arial, sans-serif"><b>FUNCIÓN LABORAL</b></th>
      <th colspan="25" style="text-align:center;font-size: 12px;width:25%;font-family: Helvetica, Arial, sans-serif"><b>DUI</b></th>
    </tr>
    <tr>
      <td colspan="45" style="text-align:center;font-size: 14px;width:45%;text-align: center"><span id="paciente_orden"></span></td>
      <td colspan="30" style="text-align:center;font-size: 14px;width:30%;text-align: center"><span id="funcion_pac_orden"></span></td>
      <td colspan="25" style="text-align:center;font-size: 14px;width:25%;text-align: center"><span id="dui_pac_orden"></span></td>
    </tr>

    <tr class="bg-light">
      <th colspan="10" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:10%;font-size: 12px"><b>EDAD</b></th>
      <th colspan="20" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:20%;font-size: 12px"><b>NIT</b></th>
      <th colspan="15" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:15%;font-size: 12px"><b>TELEFONO</b></th>
      <th colspan="30" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:30%;font-size: 12px"><b>TEL. OFICINA</b></th>
      <th colspan="25" style="font-family: Helvetica, Arial, sans-serif;text-align:center;width:25%;font-size: 12px"><b>CORREO</b></th>
    </tr>
    <tr>
      <td colspan="10" style="text-align:center;width:10%;text-align: center;font-size: 14px"><span id="edad_pac_orden"></span></td>
      <td colspan="20" style="text-align:center;width:20%;text-align: center;font-size: 14px"><span id="nit_pac_orden"></span></td>
      <td colspan="15" style="text-align:center;width:15%;text-align: center;font-size: 14px"><span id="tel_pac_orden"></span></td>
      <td colspan="30" style="text-align:center;width:30%;text-align: center;font-size: 14px"><span id="tel_of_pac_orden"></span></td>
      <td colspan="25" style="text-align:center;width:25%;text-align: center;font-size: 14px"><span id="correo_pac_orden"></span></td>
    </tr>
    <tr>
      <td colspan="100" style="font-size:14px;text-align:left;font-family: Helvetica, Arial, sans-serif;width:100%">&nbsp;&nbsp;<b>DIRECCIÓN COMPLETA:</b>&nbsp;<span id="dir_pac_orden"></span></td>
      
    </tr>
  </table>
            <!--DETALLES DE CREDITO SOLICITADO SE CARGA DESDE CREDITOS.JS funcion acciones_oid.js-->
  <table width="100%" class="table-hover table-bordered display nowrap">
    <thead style="text-align: center" class="table-hover table-bordered display nowrap">
      <tr class="bg-info">
        <th colspan="100" style="color:white;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DETALLE CRÉDITO</b></th>  
      </tr>
      <tr>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">MONTO</th>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">PLAZO</th>
        <th colspan="10" style="text-align:center;font-size: 12px;width: 10%">CUOTA</th>
        <th colspan="35" style="text-align:center;font-size: 12px;width: 35%">REFERENCIA 1</th>
        <th colspan="35" style="text-align:center;font-size: 12px;width: 35%">REFERENCIA 2</th>
      </tr>
      </thead>
      <tbody style="text-align: :center">
        <tr>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="monto_orden"></span></td>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="plazo_orden"></span></td>
          <td colspan="10" style="text-align:center;width: 10%;font-size: 14px"><span id="cuota_orden"></span></td>
          <td colspan="35" style="text-align:center;width: 35%;font-size: 14px"><span id="ref1_orden"></span></td>
          <td colspan="35" style="text-align:center;width: 35%;font-size: 14px"><span id="ref2_orden"></span></td>
        </tr>      
      </tbody>
    </table><br><br>
      <table width="100%" class="table-hover table-bordered display nowrap">
    <thead style="text-align: center" class="table-hover table-bordered display nowrap">
      <tr class="bg-info">
        <th colspan="100" style="color:white;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DETALLE ORDENES PRODUCTO</b></th>  
      </tr>
      <tr>
        <th colspan="25" style="text-align:center;font-size: 12px;width: 25%">CANTIDAD</th>
        <th colspan="50" style="text-align:center;font-size: 12px;width: 50%">DESCRIPCION</th>
        <th colspan="25" style="text-align:center;font-size: 12px;width: 25%">PRECIO</th>
      </tr>
      </thead>
      <tbody style="text-align:center" id="detalle_productos_orden">
      </tbody>
    </table><br>
</div>


<div class="modal-footer justify-content-between" id="btns_orden">
  <button type="button" class="btn btn-danger" data-dismiss="modal" onClick="aprobar_od_planilla();"><i class="fas fa-thumbs-o-down" aria-hidden="true"></i> DENEGAR</button>
  <button type="button" class="btn btn-success" onClick="aprobar_od_planilla();"><i class="fas fa-thumbs-o-up" aria-hidden="true"></i> APROBAR</button>
</div>
</div><!--Fin Card-->
</div>
  </div><!-- /.card-body -->  
  </div><!--Fin modal Content-->


<script type="text/javascript" src="js/cleave.js"></script>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

var dui = new Cleave('#dui_pac', {
  delimiter: '-',
  blocks: [8,1],
  uppercase : true
});

var dui = new Cleave('#nit_pac', {
  delimiter: '-',
  blocks: [4,6,3,1],
  uppercase : true
});

var dui = new Cleave('#tel_pac', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_of_pac', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_ref1', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
var dui = new Cleave('#tel_ref2', {
  delimiter: '-',
  blocks: [4,4],
  uppercase : true
});
</script>