<?php
require_once('modelos/Externos.php');
$marca = new Externos();
$marcas=$marca->get_marca();
?>
<style>
	#tamModal{
		width: 60% !important;
	}
	#head{
		background-color: black;
		color: white;
		text-align: center;
	}
</style>

<div class="modal fade" role="dialog" aria-labelleddy="myLargeModalLabel" id="accesorios_save" style="border-radius:0px !important;">
	<div class="modal-dialog modal-lg" role="document" id="tamModal">
		<div class="modal-content">

		<!--cabecera de la modal  guardar accesorio-->		
		<div class="modal-header" id="head" style="justify-content: space-between;">
		<span><i class="fas fa-plus-square"></i> GUARDAR ACCESORIOS</span>
      	<button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>	
		</div>
	
		<!-- cuerpo de la modal guardar accesorio-->
		<section style="margin:15px">
			<div class="form-row">

				<div class="form-group col-md-2">
					<label>Cod. Acc.</label>
					<input type="text" class="form-control" name="" id="cod_acc" onkeyup="mayus(this)">
				</div>
				
				<div class="form-group col-md-5">
					<label>Tipo accesorio</label>
					<select class="form-control" id="tipo_accesorio">
						<option value="">Seleccione...</option>
						<option value="Estuche">Estuche</option>
						<option value="Franela">Franela</option>
						<option value="Spray de limpieza">Spray de limpieza</option>
						<option value="Lente de contacto">Lente de contacto</option>
						<option value="Adaptador Anatomico">Adaptador Anatomico</option>
					</select>
				</div>
				<div class="form-group col-md-5">
					<label>Marca</label>
					<select class="form-control" id="marca_accesorio">
						<option value="">Seleccione marca</option>
        				<?php 
      						for ($i=0; $i < sizeof($marcas); $i++) {  ?>
       						 <option value="<?php echo($marcas[$i]["marca"]) ?>"><?php echo $marcas[$i]["marca"]?></option>
        				<?php } ?>
     
					</select>
				</div>
				<div class="form-group col-md-12">
					<label>Descripción</label>
					<input type="text" class="form-control" name="" id="des_accesorio" onkeyup="mayus(this)">
				</div>
				
			</div>
			<input type="hidden" name="" id="categoria" value="accesorios">
			<!-- pie modal guardar accesorios -->
            <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-block" onClick="guardar_accesorios();"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </section>
    	</div>
	</div>
</div>
		
<script type="text/javascript">
	function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>
