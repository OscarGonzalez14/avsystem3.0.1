<style>
    #tamModal_orden_desc{
      max-width: 95% !important;
    }
     #head_oid{
        background-color: #000080;
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
    .modal-body{
      max-height: calc(100vh-200px);
      overflow-y: auto;
    }
</style>
<head>
  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'> 
</head>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="oid" style="border-radius:0px !important;">
  <div class="modal-dialog modal-dialog-scrollable" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i> FORMULARIO DESCUENTO EN PLANILLA #</span><span id="correlativo_orden"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
      <div class="card card-danger" style="margin-top: 5px">
     <div class="form-group col-md-2">
      <label for="inputCity">Plazo</span></label>
      <input type="hidden" class="form-control" id="plazo_credito">
    </div>
      
  <div class="form-row" style="margin: 5px;font-size: 12px">

    <div class="form-group col-md-4">
      <label for="inputEmail4">Títular</label>
      <input type="text" class="form-control" id="paciente_empresarial" readonly="">
    </div>
        <div class="form-group col-md-4">
      <label for="inputEmail4">Beneficiario</label>
      <input type="text" class="form-control" id="benef_empresarial" readonly="">
    </div>

    <div class="form-group col-md-2">
      <label for="inputCity">Inicio</span></label>
      <input type="date" class="form-control" id="fecha_inicio" onClick="calculaFinCredito();" placeholder="INICIO CREDITO">
    </div>

    <div class="form-group col-md-2">
      <label for="inputCity">Finaliza</span></label>
      <input type="text" class="form-control" id="end_credito" readonly="">
    </div>

    <div class="input-group col-md-12">
        <input type="text" class="form-control" placeholder="AGREGAR EMPRESA" aria-label="AGREGAR EMPRESA" aria-describedby="basic-addon2" readonly="" id="empresa">
        <div class="input-group-append">
          <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#empresasModal" onClick="listar_en_pacientes();"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <div class="form-group col-md-5">
      <label for="inputPassword4">Función Laboral</label>
      <input type="text" class="form-control" id="funcion_laboral" onkeyup="mayus(this);">
    </div>

    <div class="form-group col-sm-2">
      <label for="inputAddress">Edad</label>
      <input type="text" class="form-control" id="edad_pac">
    </div>

    <div class="form-group col-sm-2">
      <label for="inputAddress2">DUI <span class="obs">*</span></label>
      <input type="text" class="form-control" id="dui_pac">
    </div>

    <div class="form-group col-sm-3">
     <label for="inputAddress2">NIT</label>
     <input type="text" class="form-control" id="nit_pac">
    </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Telefono <span class="obs">*</span></label>
      <input type="text" class="form-control" id="tel_pac">
    </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Tel. Oficina <span class="obs">*</span></label>
      <input type="text" class="form-control" id="tel_of_pac">
    </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Correo</label>
      <input type="text" class="form-control" id="corre_pac">
    </div>

    <div class="form-group col-md-12">
      <label for="inputCity">Direccion Completa <span class="obs">*</span></label>
      <input type="text" class="form-control" id="direccion_pac" onkeyup="mayus(this);">
    </div>
     
    <div class="form-group col-md-8">
      <label for="inputCity">1° Referencia <span class="obs">*</span></label>
      <input type="text" class="form-control" id="ref_1" onkeyup="mayus(this);">
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputCity">Telefono 1° Ref. <span class="obs">*</span></label>
      <input type="text" class="form-control" id="tel_ref1">
    </div>

    <div class="form-group col-md-8">
      <label for="inputCity">2° Referencia <span class="obs">*</span></label>
      <input type="text" class="form-control" id="ref_2" onkeyup="mayus(this);">
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputCity">Telefono 2° Ref. <span class="obs">*</span></label>
      <input type="text" class="form-control get_correlativo_o" id="tel_ref2">
    </div>

  <div class="form-group purple-border col-md-12">
  <label for="exampleFormControlTextarea4">Observaciones</label>
  <textarea class="form-control" id="observaciones_oid" rows="2" onkeyup="mayus(this);"></textarea>
</div>

  </div> 
 <button class="btn btn-outline-primary btn-block" type="button" id="btn_reg_orden" onClick="guardar_oid();"><i class="fas fa-save"> Registrar Orden</i></button>
 <a class="btn btn-primary" style="color:white;border-radius:1px;" href="" id="print_orden_descplanilla" target="_blank"><i class="fas fa-print"></i> IMPRIMIR ORDEN DE DESCUENTO</a>
 <a class="btn btn-success" style="color:white;border-radius:1px;" href="" id="print_pagare" target="_blank"><i class="fas fa-print"></i> IMPRIMIR PAGARÉ</a>


 
</div><!--Fin Card-->
</div>
  </div><!-- /.card-body -->  
  </div><!--Fin modal Content-->
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="   crossorigin="anonymous"></script>

<script type="text/javascript" src="js/cleave.js"></script>
<script>
$( function() {
    $( "#fecha_inicio" ).datepicker();
  } );

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