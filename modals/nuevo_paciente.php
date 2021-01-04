  <style>
    #pac_tamano{
      max-width: 65% !important;
      margin: auto;
    }
    #head_pac{
      background-color:#034f84;
      color: white;
    }
}
</style>      

      <div class="modal fade bd-example-modal-lg" role="dialog" id="newPaciente">
        <div class="modal-dialog" id="pac_tamano">
          <div class="modal-content">
            <div class="modal-header" id="head_pac">
              <h5 class="modal-title">CREAR NUEVO PACIENTE</h5>
              <button type="button" class="close justify-content-between" data-dismiss="modal" aria-label="Close" onClick="destroy_edits();">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row">
                <div class="col-sm-2">
                  <label>Cod.</label>
                  <input type="text" class="form-control" id="codigo_paciente" name="codigo_paciente" value="" >
                </div>

                <div class="col-sm-3">
                  <label>Tipo Paciente</label>
                  <select name="tipo_paciente" class="form-control" id="tipo_paciente">
                    <option value="Sucursal" selected="true">Sucursal</option>
                    <option value="Desc_planilla">Desc. Planilla</option>
                    <option value="Cargo_a">Cargo A.</option>
                    <option value="C_personal">Crédito Personal</option>                
                  </select>         
                </div>

                <div class="col-sm-7">
                  <label for="ex1">Nombre<span style="color:red">*</span></label>
                  <input class="form-control" id="nombres" name="nombres" type="text" placeholder="Escriba el Nombre del paciente"  required onkeyup="mayus(this);">      
                </div>
                
                <div class="col-sm-3">
                  <label for="ex2">Teléfono<span style="visibility: hidden;color: red" id="label_telefono">*</span></label>
                  <input class="form-control" id="telefono" type="text" name="telefono" required pattern='^[0-9]+'>
                </div>

                <div class="col-sm-2">
                  <label for="ex3">Edad</label>
                  <input class="form-control" id="edad" type="number" name="edad" placeholder="edad" required pattern='^[0-9]+'>
                </div>

                <div class="col-sm-3">
                  <label for="ex3">DUI<span style="visibility: hidden;color: red" id="label_dui">*</span></label>
                  <input class="form-control" id="dui" type="text" name="dui" placeholder="DUI" required pattern='^[0-9]+'>
                </div>

                <div class="col-sm-4">
                  <label for="ex3">Correo</label>
                  <input class="form-control" id="correo" type="text" name="correo" placeholder="correo del paciente" required>
                </div>

                <div class="col-sm-3">
                  <label for="ex3">Ocupación</label>
                  <input class="form-control" id="ocupacion" type="text" name="ocupacion" placeholder="ocupacion del paciente" onkeyup="mayus(this);" required>
                </div>

            </div><!--Fin form-group-->
              
              <div class="dropdown-divider"></div>
              <div id="btns_credito">
                
                <div class="form-group row" style="display: none">
                  <div class="col-sm-5">
                  <label>Empresa<span style="visibility: hidden;color: red" id="label_empresa">*</span></label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="empresa">
                    <div class="input-group-append">
                      <span class="input-group-text bg-success" data-toggle="modal" data-target="#empresasModal" onClick="listar_en_pacientes();" style="color: white"><i class="fas fa-search"></i></span>
                    </div>
                  </div>
                </div>

                  <div class="col-sm-4">
                    <label>NIT</label>
                    <input class="form-control" id="nit" type="text" name="nit" placeholder="" required pattern='^[0-9]+'>
                  </div>

                  <div class="col-sm-3">
                    <label>Telefono de Oficina<span style="visibility: hidden;color: red" id="label_tel_of">*</span></label>
                    <input class="form-control" id="tel_oficina" type="text" name="tel_oficina" placeholder="" required pattern='^[0-9]+'>
                  </div>
                  
                  <div class="col-sm-12">
                    <label>Dirección Completa<span style="visibility: hidden;color: red" id="label_direccion">*</span></label>
                    <input class="form-control" id="direccion_completa" type="text" name="direccion_completa" placeholder="" required onkeyup="mayus(this);">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <input id="id_paciente" type="hidden">
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" onClick="guardarPaciente();" id="save_paciente"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>Guardar</button>
              <button class="btn btn-primary btn-block" onClick="guardarPaciente();" id="edit_paci">Editar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->