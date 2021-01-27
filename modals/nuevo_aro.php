<?php
require_once('modelos/Externos.php');
$marca = new Externos();
$marcas=$marca->get_marca();
?>
<style>
  #new_aro{
    width: 70% !important;
    position: fixed;
    display: flex;
  }
  #head{
    background-color: black;
    color: white;
    text-align: center;
  }
.modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}

</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nuevo_aro" style="border-radius:0px !important;margin-top: 30px;" >
  <div class="modal-dialog modal-lg" role="document" id="tamModal">

    <div class="modal-content">
     <div class="modal-header" id="head" style="justify-content:space-between">
       <span><i class="fas fa-plus-square"></i>CREAR ARO</span>
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
     </div>
     <div id="resultados_ajax"></div>
<section style="margin:15px">
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
        <option value="Completo">Completo</option>
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
<input type="hidden" id="categoria_producto" value="aros"/>
<button class="btn btn-primary btn-block" style="border-radius:0px" onClick="guardarAro();"><i class="fas fa-save"></i> Guardar</button>
</section>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript">
  function mayus(e) {
       e.value = e.value.toUpperCase();
  }

  var medidas = new Cleave('#medidas_aro', {
    delimiter: '-',
    blocks: [2,2,3],
    uppercase: true
});


function limpiar_input() {
    document.getElementById("marca").value = "";
  }
</script>
