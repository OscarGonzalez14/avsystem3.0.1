<style>
    .fullscreen-modal .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .fullscreen-modal .modal-dialog {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .fullscreen-modal .modal-dialog {
     width: 1170px;
  }
}
.modal-body{
  height:400px;
  width: 100%;
  overflow-y: auto;
}
.modal-dialog-center { /* Edited classname 10/03/2014 */ margin: 0; position: absolute; top: 50%; left: 50%; }


</style>

<!-- The Modal -->
  <div id="modal_ingreso_bodega" class="modal fullscreen-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ingresar Productos a Bodega</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <table class="table-hover" id="data_productos_ingresos_bodega" width="100%">
                  <thead style="background:#034f84;color:white">
                    <tr>
                      <th style="text-align:center">ID</th>
                      <th style="text-align:center"># Compra</th>
                      <th style="text-align:center">Descripción</th>
                      <th style="text-align:center">Cantidad disponible</th>
                      <th style="text-align:center">Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center">
                                        
                  </tbody>
                </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>