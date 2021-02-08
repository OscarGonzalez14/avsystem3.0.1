<style>
    #ccf_tamano{
      max-width: 65% !important;
    }

    .ord_1{
      width: 25%;
      color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      background: #004080;
      width: 25%;
    }
    .ord_2{
      width: 25%;
      color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      width: 25%;
    }
</style>

<div class="modal fade" id="ingreso_ccf_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="ccf_tamano">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INGRESO DE CREDITOS FÍSCALES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="form-row">
      <div class="form-group col-md-3">
        <label>Laboratorio</label>
        <input type="text" class="form-control" id="laboratorio_ccf" readonly>
      </div>

      <div class="form-group col-md-5">
        <label>Paciente</label>
        <input type="text" class="form-control" id="evaluado_cff" readonly>
      </div>

      <div class="form-group col-md-2">
        <label>Fecha</label>
        <input type="text" class="form-control" id="evaluado_det">
      </div>

      <div class="form-group col-md-2">
        <label>CCF</label>
        <input type="text" class="form-control" id="laboratorio_det">
      </div>      

      </div><!--Fin Form Row-->

      <table class="table-striped" id="notas_contacto" width="100%">
        <thead style="text-align: center;">
          <th colspan="15" style="width: 15%;text-align: center">Fecha</th>
          <th colspan="15" style="width: 15%;text-align: center">usuario</th>
          <th colspan="70" style="width: 70%;text-align: center">Observacion</th>
        </thead>
         <tbody id="listar_items_ccf" style="text-align: center"></tbody>
      </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" style="margin: border-radius:0px">Ingresar CCF</button>
      </div>
    </div>
  </div>
</div>