<style>
    #ccf_tamano{
      max-width: 85% !important;
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
    .table2 {
       border-collapse: collapse;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       text-align: center;
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

      <table class="table-bordered table-hover table2" id="notas_contacto" width="100%">
        <thead style="text-align: center;">
          <th colspan="45" style="width: 45%;text-align: center" class="stilot1">Descripción</th>
          <th colspan="15" style="width: 15%;text-align: center" class="stilot1">Cantidad</th>
          <th colspan="10" style="width: 10%;text-align: center" class="stilot1">P.Unit.</th>
          <th colspan="10" style="width: 10%;text-align: center" class="stilot1">V. Gravadas</th>
         <th colspan="20" style="width: 20%;text-align: center" class="stilot1">13% IVA</th>

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