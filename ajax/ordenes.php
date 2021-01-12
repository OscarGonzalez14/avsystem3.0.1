<?php

require_once("../config/conexion.php");

require_once("../modelos/Ordenes.php");
 
$ordenes = new Ordenes();

switch($_GET["op"]){

  case "get_consultas":
	$datos=$ordenes->get_consultas_orden($_POST["sucursal"]);
 	$data= Array();
    foreach($datos as $row){
		$sub_array = array();
        $sub_array[] = $row["id_paciente"];				
		$sub_array[] = $row["nombres"];
		$sub_array[] = $row["p_evaluado"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = '<button type="button"  class="btn btn-infos btn-md asigna_datos_orden" onClick="agregaIngreso('.$row["id_paciente"].','.$row["id_consulta"].',\''.$row["p_evaluado"].'\');"><i class="fas fa-plus"></i> Agregar</button>';                                 
		$data[] = $sub_array;
	}
        $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
}