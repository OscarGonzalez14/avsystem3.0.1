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

            <table width="100%">
              <thead style="text-align: center" class="bg-info table-hover table-bordered display nowrap">
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
                  <td style="text-align:center"><span id="paciente_det_abono"></span></td>
                  <td style="text-align:center"><span id="monto_det_abono"></span></td>
                  <td style="text-align:center"><span id="total_abonado"></span></td>
                  <td style="text-align:center"><span id="saldo_det_abono"></span></td>
                  <td style="text-align:center"><span id="saldo_det_abono"></span></td>
                </tr>      
              </tbody>
            </table><br>

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