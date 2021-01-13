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
 		$sub_array[] = $row["id_consulta"];		
		$sub_array[] = $row["nombres"];
		$sub_array[] = $row["p_evaluado"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = $row["fecha_consulta"];
        $sub_array[] = '<button type="button"  class="btn btn-outline-secondary btn-xs asigna_datos_orden" onClick="agregaConsultaOrden('.$row["id_paciente"].','.$row["id_consulta"].',\''.$row["p_evaluado"].'\');"><i class="fas fa-plus-circle" style="color: green"></i> Seleccionar</button>';                                 
		$data[] = $sub_array;
	}
        $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

    case 'get_numero_venta':
        
        $datos = $ordenes->get_numero_venta($_POST["id_paciente"],$_POST["evaluado"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["numero_venta"] = $row["numero_venta"];
            }
        echo json_encode($output);
        }

        break;

    case 'get_items_venta':
        $datos = $ordenes->get_items_venta($_POST["id_paciente"],$_POST["numero_venta"]);
        if (is_array($datos)==true and count($datos)>0) {
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id_producto"];
                $data[] = $sub_array;
            }
            echo json_encode($data);
        }
        break;

    case 'get_categoria_producto':
        
        $datos = $ordenes->get_categoria_producto($_POST["codProd"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["categoria_producto"] = $row["categoria_producto"];
            }
        echo json_encode($output);
        }

        break;
}