<?php
require_once("../config/conexion.php");
// llamada al modelo Accesorios
require_once("../modelos/Accesorios.php");

$accesorios = new Accesorios();

switch ($_GET["op"]){
	case 'guardar_accesorios':
	$accesorios->registrar_accesorios($_POST["marca_accesorio"],$_POST["des_accesorio"],$_POST["tipo_accesorio"],);
		break;
}
 ?>