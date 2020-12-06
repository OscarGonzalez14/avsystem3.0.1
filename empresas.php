<?php
require_once("config/conexion.php");

if(isset($_SESSION["usuario"])){

require_once('header.php');
require_once('modals/empresa.php');
 ?>


<div class="content-wrapper" >
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newEmpresa">
  	CREAR NUEVA EMPRESA
  </button>
</div>

<script src="js/empresas.js"></script>
<?php } else{
echo "Acceso denegado";
header("Location:index.php");
        exit();
  } ?>
