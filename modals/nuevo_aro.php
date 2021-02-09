<!-- Modal -->
<div class="modal fade" id="nuevo_aro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVO ARO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-row" autocomplete="on">
    <div class="form-group  col-md-6">
      <button class="btn btn-success" style="color:white; margin:solid black 1px" data-toggle="modal" data-target="#newMarca" onClick="limpiar_input();"><i class="fas fa-plus-square"></i> Crear Marca</button>
    </div>
    
   <div class="form-group col-md-6">
      <input type="hidden">
   </div>
  

    <div class="form-group col-md-4">
       <label for="sel1">Seleccione marca:</label>
      <select class="form-control" name="" id="marca_aros"></select>
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputPassword4">Modelo</label>
      <input type="text" class="form-control" id="modelo_aro" placeholder="Escriba el Modelo" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-4">
      <label for="inputPassword4">Color</label>
      <input type="text" class="form-control" id="color_aro" placeholder="Escriba el color" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-3">
      <label for="inputEmail4">Medidas</label>
      <input type="text" class="form-control" id="medidas_aro" placeholder="Medidas" required="" onkeyup="mayus(this);" >
    </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">Diseño</label>
      <select class="form-control" id="diseno_aro" required="">
        <option value="">Seleccionar Diseño</option>
        <option value="Completo">Cerrado</option>
        <option value="Semi-Aereo">Semi Aereo</option>
        <option value="Aereo">Aereo</option>
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="inputPassword4">Materiales</label>
      <select class="form-control" id="materiales_aro" required="">
        <option value="">Seleccionar Material</option>
        <option value="Metal">Metal</option>
        <option value="Acetato">Acetato</option>
        <option value="Metal/Acetato">Metal/Acetato</option>
        <option value="Fibra de Carbono">Fibra de Carbono</option>
        <option value="Titanio">Titanio</option>
        <option value="TR90">TR90</option>
      </select>
    </div>

    <div class="form-group col-md-3">
      <label for="exampleFormControlSelect2">Categoría</label>
      <select id="cat_venta_aros" class="form-control" required="">
        <option value='Básico'>Básico</option>
        <option value='Intermedio'>Intermedio</option>
        <option value='Premium'>Premium</option>
      </select>
    </div>
  </div>
      </div>
      <input type="hidden" id="categoria_producto" value="aros"/>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" onClick="guardarAro();"><i class="fas fa-save"></i>GUARDAR</button>
      </div>
    </div>
  </div>
</div>