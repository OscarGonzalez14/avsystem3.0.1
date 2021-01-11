<style>
    #tamModal_orden_desc{
      max-width: 85% !important;
    }
     #head_oid{
        /*background-color: black;*/
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
    .eight h1 {
    //background: red;
    text-align:center; 
    text-transform:uppercase;
    font-size:14px; letter-spacing:1px;  
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    grid-template-rows: 16px 0;
    grid-gap: 22px;
  }

  .eight h1:after,.eight h1:before {
   content: " ";
   display: block;
   border-bottom: 2px solid #ccc;
   background-color:#f8f8f8;
}
</style>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nueva_orden_lab" style="border-radius:0px !important;">
  <div class="modal-dialog modal-dialog-scrollable" role="document" id="tamModal_orden_desc">

  <div class="modal-content">
  <div class="modal-header bg-info" id="head_oid" style="justify-content:space-between">
    <span><i class="far fa-file-alt"></i> ORDEN DE LABORATORIO</span><span id="correlativo_orden"></span>
    <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
  </div>
    <div class="modal-body">
  <div class="card card-danger" style="margin-top: 3px">

<div class="eight" style="">
    <strong><h1 style="color: #034f84">DATOS GENERALES</h1></strong>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <label for="inlineFormInputGroup">Seleccionar Paciente</label>
      <div class="input-group">
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Buscar Paciente">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-search" style="color: blue"></i></div>
          </div>
      </div>
    </div>

    <div class="form-group col-sm-2">
      <label for="inputPassword4">Tipo Venta</label>
      <select class="form-control" id="empresa_paciente" required>
        <option value="">Seleccionar Tipo Venta...</option>
        <option value="Contado">Contado</option>
        <option value="Descuento en Planilla">Descuento en Planilla</option>
        <option value="Cargo Automatico">Cargo Automatico</option>
      </select>
    </div>

    <div class="form-group col-sm-2">
      <label for="inputPassword4">Sucursal</label>
      <select class="form-control" id="empresa_paciente" required>
        <option value="">Seleccionar sucursal...</option>
        <option value="Metrocentro">Metrocentro</option>
        <option value="Arce">Arce</option>
        <option value="Santa Ana">Santa Ana</option>
        <option value="San Miguel">San Miguel</option>
     </select>
    </div>

    <div class="form-group col-sm-3">
      <label for="inputPassword4">Laboratorio</label>
      <select class="form-control" id="empresa_paciente" required>
        <option value="">Seleccionar Laboratorio...</option>
        <option value="Lomed">Lomed</option>
        <option value="Lenti">Lenti</option>
        <option value="Opti Procesos">Opti Procesos</option>
        <option value="PrismaLab">PrismaLab</option>
    </select>
    </div>
  </div>
</div><!--fin eigth #1-->

<div class="eight">
  <strong><h1 style="color: #034f84">GRADUACIÓN</h1></strong>
  <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>      
        <th style="text-align:center">ADICION</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasf" id="odesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosf" id="odcilindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesf" id="odejesf"></td>     
        <td> <input type="text" class="form-control" placeholder="---" name="oddicionf" id="oddicionf" onKeyup="fill_rx()"></td>                
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" id="oiesferasf" ></td>
        <td> <input type="text" class="form-control" placeholder="---" id="oicolindrosf" ></td>
        <td> <input type="text" class="form-control" placeholder="---" id="oiejesf" ></td>      
        <td> <input type="text" class="form-control" placeholder="---" id="oiadicionf"></td>        
      </tr>
  </table>
</div>

<div class="eight">
  <h1>TIPO DE LENTE + TRATAMIENTO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">LENTE</i></div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup">
      </div>
    </div>

    <div class="form-group col-sm-7">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">TRATAMIENTO</i></div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup">
      </div>
    </div>
  </div>


</div>

<div class="eight">
  <h1>MEDIDAS</h1>
    <table width="100%">
      <thead>
        <th colspan="20" style="width: 20%"></th>
        <th colspan="20" style="width: 20%"></th>
        <th colspan="5" style="width: 5%"></th>
        <th colspan="5" style="width: 5%;text-align: center">DIP</th>
        <th colspan="5" style="width: 5%;text-align: center">AP</th>
        <th colspan="5" style="width: 5%;text-align: center">AO</th>
        <th colspan="20" style="width: 20%"></th>
        <th colspan="20" style="width: 20%"></th>
      </thead>
      <tr>
        <td colspan="20"></td>
        <td colspan="20"></td>
        <td colspan="5" style="border-bottom: solid 2px black;text-align:center">OD</td>
        <td colspan="5" style="border-bottom: solid 2px black;border-left: solid 1px black;text-align:center">31</td>
        <td colspan="5" style="border-bottom: solid 2px black;border-left: solid 1px black;text-align:center"></td>
        <td colspan="5" style="border-bottom: solid 2px black;border-left: solid 1px black;text-align:center"></td>
        <td colspan="20"></td>
        <td colspan="20"></td>
      </tr>
      <tr>
        <td colspan="20"></td>
        <td colspan="20"></td>
        <td colspan="5" style="text-align:center">OI</td>
        <td colspan="5" style="border-left: solid 1px black;text-align:center">31</td>
        <td colspan="5" style="border-left: solid 1px black;text-align:center"></td>
        <td colspan="5" style="border-left: solid 1px black;text-align:center"></td>
        <td colspan="20"></td>
        <td colspan="20"></td>
      </tr>
    </table><br>
</div>  

<div class="eight">
  <h1>ARO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">
    <div class="form-group col-sm-3">
      <label for="">Tipo</label>
      <input type="text" class="form-control" id="inlineFormInputGroup">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Marca</label>
      <input type="text" class="form-control" id="inlineFormInputGroup">
    </div>

      <div class="form-group col-sm-3">
      <label for="">Color</label>
      <input type="text" class="form-control" id="inlineFormInputGroup">
    </div>

      <div class="form-group col-sm-3">
      <label for="">Diseño</label>
      <input type="text" class="form-control" id="inlineFormInputGroup">
    </div>

  </div>
</div> 
</div><!--Fin Card-->
</div>
  </div><!-- /.card-body -->  
  </div><!--Fin modal Content-->
</div>

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