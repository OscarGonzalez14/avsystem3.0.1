<?php

$fecha_actual = "2021-01-10";

//sumo 1 mes
echo date("d-m-Y",strtotime($fecha_actual."+ 1 month"))."<br>"; 
//resto 1 mes
echo date("d-m-Y",strtotime($fecha_actual."- 1 month"))."<br>";

$fecha_actual = date("d-m-Y");
//sumo 1 mes
echo date("d-m-Y",strtotime($fecha_actual."+ 1 month"))."<br>"; 
//resto 1 mes
echo date("d-m-Y",strtotime($fecha_actual."- 1 month"))."<br>";


/* Ejemplo 1 de foreach: sólo el valor */
$a = array(1, 2, 3, 17);

foreach ($a as $v) {
    echo "Valor actual de a:".$v."<br>";
}
?>
<html>
	 <div class="form-group col-md-4">
      <label for="exampleFormControlSelect2">Marca</label>
      <select class="form-control input-dark gui-input" id="marca_aros">
       <option value="">Seleccione marca</option>
      <?php 
      foreach ($a as $v) {  ?>
        <option value="<?php echo $v; ?>"><?php echo  $v;?></option>
        <?php } ?>
     </select>
      </div>
</html>


<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once("encabezado.php");
require_once('modals/show_categorias_impresion.php');



//$departamentos = array()
?>
<div class="content-wrapper">
<?php $empresa = $_SESSION["nombres"];

if ($empresa == "Kappa") {
  $emp = array("Corrugado","Ecofibra","Plegadizo","Flexible");
}

?>

    <div class="form-group row" style="margin-top: 10px;margin-left:10px">
      <div class="col-sm-3">
        <label style="text-transform: uppercase;">EMPRESA:&nbsp;<?php echo  $_SESSION["nombres"];?></label>
        <select class="form-control" id="empresa_act" style="border:2px solid lightblue">
          <option value="">Seleccione departamento ...</option>
          <?php 
           foreach ($emp as $v) {  ?>
            <option value="<?php echo $v; ?>"><?php echo  $v;?></option>
          <?php } ?>
        </select>         
      </div>
    </div>

<div class="card-body p-0" style="margin:1px">
  <table id="estado_pacientes_emp" class="table-hover table-bordered"
  width="100%" data-order='[[ 0, "desc" ]]' style="text-align: center;text-align:center">
        <thead class="bg-primary">
          <tr>
          <th style="width: 40%">Nombre</th>          
          <th>Cod. Empleado</th>
          <th>Empresa</th>
          <th>Departamento</th>
          <th>Estado</th>
          <th>Diagnostico</th>
          <th>Examenes</th>
          <th>Acciones</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                  
        </tbody>
      </table>
    </div>

<?php require_once("foot.php");?>	
</div>
<script src="js/ordenes.js"></script>
<script src="js/bootbox.min.js"></script>
<?php } else{
echo "Acceso denegado";
  } ?>






