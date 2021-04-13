<style>
  #tamModal_oc{
    max-width: 60% !important;
  }
  #head_oc{
    background-color: black;
    color: white;
    text-align: center;
  }
</style>
<div class="modal" role="dialog" id="modal_ordenes_cobro">
  <div class="modal-dialog" role="document" id="tamModal_oc">
    <div class="modal-content">
      <div class="modal-header" id="head_oc">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p><b>EMPRESA: <span id="empresa_oc" style="color: blue"></span></b></p>
        <div class="row">
          <div class="col-sm-4">
              <label for="sel1">Tipo Pago</label>
              <select class="form-control" id="tipo_pago_oc">
                <option>Cheque</option>
                <option>Efectivo</option>
                <option>Transferencia</option>
              </select>
          </div>

          <div class="col-sm-4">
            <label>Forma Abono</label>
              <select class="form-control" id="forma_abono">
                <option>Agrupado</option>
                <option>Individual</option>
              </select>
          </div>
          <div class="col-sm-4">
            <label for="sel1">Comprobante</label>
            <input type="text" class="form-control" id="comprobante_oc">
          </div>    
        </div>
      </div><!--Fin Body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block">Guardar</button>
        
      </div>
    </div>
  </div>
</div>