  <style >
    #tanModal{
      max-width: 70% !important;
    }
    #head{
      background-color: black;
      color: white;
      text-align: center;
   	}
	.modal-dialog {
      height: 75vh;
      display: flex;
      align-items: center;
    }
    
  </style>
  <!-- The Modal marca -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="newEmpresa" style="border-radius:0px !important;">
    <div class="modal-dialog modal-lg" id="tanModal">
      <!-- cabecera de la modal-->
      <div class="modal-content" >
        <div class="modal-header" id="head" style="justify-content: space-between">
          <span><i class="fas fa-plus-square"></i> CREAR NUEVA EMPRESA</span>
          <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row" autocomplete="on">
            <div class="form-group col-md-4">
            <label>Nombre</label>
              <input type="text"  class="form-control" name="" placeholder="Nombre de la empresa" required="" id="nomEmpresa" onkeyup="mayus(this);">
            </div>
            <div class="form-group col-md-4">
            <label>Dirección</label>
              <input type="text"  class="form-control" name="" placeholder="Dirección" required="" id="dirEmpresa" onkeyup="mayus(this);">
            </div>
            <div class="form-group col-md-4">
            <label>NIT</label>
              <input type="text"  class="form-control" name="" placeholder="NIT de la empresa" required="" id="nitEmpresa">
            </div>

            <div class="form-group col-md-4">
              <label># Registro</label>
              <input type="text"  class="form-control" name="" required="" id="registroEmpresa">
            </div>

            <div class="form-group col-md-4">
              <label>Giro</label>
              <input type="text"  class="form-control" name=""  required="" id="giroEmpresa">
            </div>

            <div class="form-group col-md-4">
            <label>Teléfono</label>
              <input type="text"  class="form-control" name="" placeholder="Teléfono de la empresa" required="" id="telEmpresa" >
            </div>
            <div class="form-group col-md-4">
            <label>Responsable de RRHH</label>
              <input type="text"  class="form-control" name="" placeholder="Responsable" required="" id="respEmpresa" onkeyup="mayus(this);" >
            </div>
            <div class="form-group col-md-4">
            <label>Correo</label>
              <input type="text"  class="form-control" name="" placeholder="Correo" required="" id="correoEmpresa" >
            </div>
            <div class="form-group col-md-12">
            <label>Encargado Optica</label>
              <input type="text"  class="form-control" name="" placeholder="Encargado" required="" id="encargado" onkeyup="mayus(this);" >
            </div>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" style="border-radius:0px" onClick="guardarEmpresa();" ><i class="fas fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>

<script>
	function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>