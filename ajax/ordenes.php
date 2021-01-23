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

    case 'get_detalle_aro':
    
        require_once("../modelos/Productos.php"); 
        $productos = new Productos();
        $datos = $productos->show_datos_aros($_POST["id_producto"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["modelo"] = $row["modelo"];
                $output["marca"] = $row["marca"];
                $output["color"] = $row["color"];
                $output["diseno"] = $row["diseno"];
            }
        echo json_encode($output);
        }
        break;

        case 'get_detalle_tratamientos':
        require_once("../modelos/Productos.php"); 
        $productos = new Productos();
        $datos = $productos->show_datos_producto_id($_POST["id_producto"]);
        if (is_array($datos)==true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["desc_producto"] = $row["desc_producto"];
            }
        echo json_encode($output);
        }
        break;

    case "get_numero_orden":
    $datos= $ordenes->get_numero_orden_lab($_POST["sucursal"]);
    $sucursal = $_POST["sucursal"];
    $prefijo = "";
    if ($sucursal=="Metrocentro") {
        $prefijo="ME";
    }elseif ($sucursal=="Santa Ana") {
        $prefijo="SA";
    }elseif ($sucursal=="San Miguel") {
        $prefijo="SM";
    }
    if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){                                
            $codigo=$row["numero_orden"];
            $cod=substr($codigo,5,11)+1;
            $output["correlativo"]="OD".$prefijo."-".$cod;
        }                           
    }else{
        $output["correlativo"] = "OD".$prefijo."-1";
    }

     echo json_encode($output);

  break;

  case 'registrarEnvio':
      $datos = $ordenes->buscar_existe_orden($_POST["numero_orden"]);
      if(is_array($datos)==true and count($datos)==0){
      $ordenes->registrar_orden($_POST["paciente_orden"],$_POST["laboratorio_orden"],$_POST["id_pac_orden"],$_POST["id_consulta_orden"],$_POST["lente_orden"],$_POST["tratamiento_orden"],$_POST["modelo_aro_orden"],$_POST["marca_aro_orden"],$_POST["color_aro_orden"],$_POST["diseno_aro_orden"],$_POST["med_a"],$_POST["med_b"],$_POST["med_c"],$_POST["med_d"],$_POST["observaciones_orden"],$_POST["id_usuario"],$_POST["fecha"],$_POST["sucursal"],$_POST["numero_orden"]);
        $messages[]="ok";
      }else{
        $errors[]="existe";
      }
    if (isset($messages)){
     ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
   <?php
 }
    //mensaje error
      if (isset($errors)){

   ?>

         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
   <?php
   }
      break;

   case 'listar_ordenes':
       $datos = $ordenes->listar_ordenes($_POST["sucursal"]);

       $data = Array();
       $i=0;
       foreach ($datos as $row) {

          if ($row["estado"]==0) {
            $badge="warning";
            $icon="fa-clock";
            $estado="Pendiente";
          }elseif($row["estado"]==1){
            $badge="success";
            $icon="fa-share-square";
            $estado="Enviado";
          }

          $sub_array = array();
          $sub_array[] = $row["id_envio"];
          $sub_array[] = '<input type="checkbox" class="form-check-input send_orden" value="'.$row["id_paciente"].'" name="'.$row["numero_orden"].'" id="send_lab'.$i.'">Enviar';          
          $sub_array[] = $row["evaluado"];
          $sub_array[] = $row["numero_orden"];
          $sub_array[] = $row["fecha_creacion"];
          $sub_array[] = ucfirst($row["usuario"]);
          $sub_array[] = '<span class="right badge badge-'.$badge.'"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i><span> '.$estado.'</span>';
          $sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm"><i class="fas fa-eye" aria-hidden="true" style="color:blue"></i></button>';
          //$sub_array[] = '<button type="button" class="btn btn-md btn-outline-secondary btn-sm" onClick="acciones_envios_lab('.$row["id_paciente"].',\''.$row["numero_orden"].'\',\''.$row["evaluado"].'\',\''.$row["estado"].'\',\''.$row["laboratorio"].'\')"><i class="fas fa-cog" aria-hidden="true" style="color:black"></i></button>';
        $data[] = $sub_array;
        $i++;
       }
      // $data[] = $sub_array;
      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
       echo json_encode($results); 
       break;
     
      case 'registrar_envio_lab':
         $ordenes->enviar_orden_lab();
         $messages[]="ok";

      if (isset($messages)){
      ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
      <?php
    }

      break;
}