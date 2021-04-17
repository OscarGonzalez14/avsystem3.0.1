<style>
  #tamModal_oc{
    max-width: 90% !important;
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
        <h5 class="modal-title">Orden de Cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p><b>EMPRESA: <span id="empresa_oc" style="color: blue"></span></b>&nbsp;&nbsp;--&nbsp;&nbsp;<b>#ORDEN: <span id="n_o" style="color: blue"></span></span></p>
        <div class="row">
          <div class="col-sm-4">
              <label for="sel1">Tipo Pago</label>
              <select class="form-control" id="tipo_pago_oc">
                <option value="0">Seleccionar...</option>
                <option value="Cheque">Cheque</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
              </select>
          </div>

          <div class="col-sm-4">
            <label>Forma Abono</label>
              <select class="form-control" id="forma_abono">
                <option value="0">Seleccionar...</option>
                <option value="Agrupado">Agrupado</option>
                <option value="Individual">Individual</option>
              </select>
          </div>
          <div class="col-sm-4">
            <label for="sel1">Comprobante</label>
            <input type="text" class="form-control" id="comprobante_oc">
          </div>    
        </div>

        <table width="100%" class="table-hover table-bordered" style="margin-top: 8px;;font-family: Helvetica, Arial, sans-serif;font-size: 12px;">
            <tr style="background:#080842;color:white;text-align: center">
              <th colspan='5' style="width: 5%">#</th>
              <th colspan='35' style="width: 35%">Paciente</th>
              <th colspan='15' style="width: 15%">Abono</th>
              <th colspan='15' style="width: 15%"># Recibo</th>
              <th colspan='15' style="width: 15%">Ingresar</th>
              <th colspan='15' style="width: 15%">Comprobante</th>
            </tr>
          <tbody style="text-align:center;border-bottom: 1px solid #787878" id="confirma_orden_cobro">                                  
          </tbody>
          <tfoot>
            <tr>
              <td colspan='40' style="text-align: center;width: 40%;border: 1px solid #787878">TOTALES</td>
              <td colspan='15' style="text-align: center;width: 15%;border: 1px solid #787878"><span id="totales_aoc"></span></td>
              <td colspan='45' style="text-align: center;width: 45%;border: 1px solid #787878"></td>
            </tr>
          </tfoot>
        </table>

      </div><!--Fin Body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" onClick="guardarComprobanteOc();">Guardar</button>
        
      </div>
    </div>
  </div>
</div>