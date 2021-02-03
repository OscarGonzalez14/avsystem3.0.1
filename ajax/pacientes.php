<?php
  require_once("../config/conexion.php");
  require_once("../modelos/Pacientes.php");
      //llamo al modelo Ventas
  //require_once("../modelos/Ventas.php");  
  $pacientes = new Paciente();
    switch($_GET["op"]){

  case "get_numero_paciente":
  $datos= $pacientes->get_numero_paciente($_POST["sucursal_correlativo"]);
	$sucursal = $_POST["sucursal_correlativo"];
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
			$codigo=$row["codigo"];
			$cod=substr($codigo,5,11)+1;
			$output["correlativo"]="AV".$prefijo."-".$cod;
		}							
	}else{
			$output["correlativo"] = "AV".$prefijo."-1";
	}

	 echo json_encode($output);

  break;

  case "guardar_paciente":

    $tipo_paciente=($_POST["tipo_paciente"]);
    $codigo=$pacientes->validar_codigo_paciente($_POST["codigo_paciente"]);
    $dui=$pacientes->validar_dui_paciente($_POST["dui"]);
    $valida_pacientes = $pacientes->valida_paciente($_POST["codigo_paciente"]);

    if (is_array($valida_pacientes)==true and count($valida_pacientes)==0 ){ //Si existe Paciente(validacion)
     
    if($tipo_paciente=="Desc_planilla" || $tipo_paciente=="Cargo_a") {
      if(is_array($codigo)==true and count($codigo)==0 and is_array($dui)==true and count($dui)==0){
      $pacientes->registrar_paciente($_POST["codigo_paciente"],$_POST["nombres"],$_POST["telefono"],$_POST["edad"],$_POST["ocupacion"],$_POST["sucursal"],$_POST["dui"],$_POST["correo"],$_POST["usuario"],$_POST["empresa"],$_POST["nit"],$_POST["tel_oficina"],$_POST["direccion_completa"],$_POST["tipo_paciente"],$_POST["fecha"]);
    $messages[]="ok";
    }else{
      $errors[]="dui";
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
  }elseif ($tipo_paciente=="Sucursal" or $tipo_paciente=="C_personal") {
    if(is_array($codigo)==true and count($codigo)==0){
      $pacientes->registrar_paciente($_POST["codigo_paciente"],$_POST["nombres"],$_POST["telefono"],$_POST["edad"],$_POST["ocupacion"],$_POST["sucursal"],$_POST["dui"],$_POST["correo"],$_POST["usuario"],$_POST["empresa"],$_POST["nit"],$_POST["tel_oficina"],$_POST["direccion_completa"],$_POST["tipo_paciente"],$_POST["fecha"]);
    $messages[]="ok";
    }else{
      $errors[]="codigo";
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
  }
}else{
    $pacientes->editar_paciente($_POST["codigo_paciente"],$_POST["nombres"],$_POST["telefono"],$_POST["edad"],$_POST["ocupacion"],$_POST["sucursal"],$_POST["dui"],$_POST["correo"],$_POST["usuario"],$_POST["empresa"],$_POST["nit"],$_POST["tel_oficina"],$_POST["direccion_completa"],$_POST["tipo_paciente"],$_POST["fecha"]);
    $messages[]="editado";
        if (isset($messages)){
     ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
   <?php
 }
  }
 
    break;

/////////////////////listado general pacintes
  case "listar_pacientes":

	$datos=$pacientes->get_pacientes($_POST["sucursal_paciente"]);
	$data= Array();
    foreach($datos as $row){
	$sub_array = array();
  $referido=$pacientes->count_referidos($row["id_paciente"]);

  if ($referido>=0 and $referido<=1) {
    $badge="light";
    $icon="fa-clock";
    $estado="";
  }elseif($referido>1 and $referido<5){
    $badge="secondary";
    $icon="fa-clock";
    $estado="";
  }elseif($referido>=5){
    $badge="green";
    $icon="fa-trophy";
    $estado="Ganador";
  }
			$sub_array[] = $row["id_paciente"];
			$sub_array[] = $row["nombres"];
      $sub_array[] = $row["edad"]." años";
			$sub_array[] = $row["telefono"];			            
      $sub_array[] = '<button type="button" onClick="mostrarc('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-md btn-outline-info btn-sm info_pac" data-toggle="modal" data-target="#consultasModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-file-alt" aria-hidden="true" style="color:blue"></i></button>';
      $sub_array[] = '<button type="button"  id="'.$row["id_paciente"].'" class="btn btn-edit btn-md edita_pacc bg-light" style="text-align:center" onClick="show_datos_paciente('.$row["id_paciente"].',\''.$row["codigo"].'\');" data-toggle="modal" data-target="#newPaciente" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
      $sub_array[] = '<button type="button"  class="btn btn-md bg-light" onClick="eliminar_paciente('.$row["id_paciente"].')"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';
      $sub_array[] = '<button type="button" onClick="mostrarc('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn  btn-md bg-light"><i class="fas fa-clipboard-list" aria-hidden="true" style="color:blue"></i></button>';
      $sub_array[] = '<span class="right badge badge-light"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i> '.$referido.'<span> '.$estado.'</span>';            
                                                
		  $data[] = $sub_array;
	}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;

     ///////////////BUSCAR PACIENTE POR ID PARA MOSTRAR EN LA VENTANA DE CONSULTAS
    case 'ver_pacientes_data':    
		$datos=$pacientes->get_paciente_por_id($_POST["id_paciente"]);
    	foreach($datos as $row)
    	{
    	$output["id_paciente"] = $row["id_paciente"];
			$output["nombres"] = $row["nombres"];
      $output["telefono"] = $row["telefono"];		
    	}
    echo json_encode($output);
	break;

  /////////////////SHOW DATOS DE PACIENTE EN MODAL PARA EDITAR
  case 'show_datos_paciente':    
    $datos=$pacientes->show_datos_paciente($_POST["id_paciente"],$_POST["codigo"]);
      foreach($datos as $row){
      $output["id_paciente"] = $row["id_paciente"];
      $output["nombres"] = $row["nombres"];
      $output["codigo"] = $row["codigo"];
      $output["telefono"] = $row["telefono"];
      $output["edad"] = $row["edad"];
      $output["ocupacion"] = $row["ocupacion"];
      $output["sucursal"] = $row["sucursal"];
      $output["dui"] = $row["dui"];
      $output["correo"] = $row["correo"]; 
      $output["fecha_reg"] = $row["fecha_reg"]; 
      $output["usuario"] = $row["usuario"]; 
      $output["empresas"] = $row["empresas"]; 
      $output["nit"] = $row["nit"];
      $output["telefono_oficina"] = $row["telefono_oficina"];
      $output["direccion"] = $row["direccion"];
      $output["tipo_paciente"] = $row["tipo_paciente"];  
      }
    echo json_encode($output);
  break;

  case "eliminar_paciente":

  $datos=$pacientes->valida_paciente_consulta($_POST["id_paciente"]);

  if (is_array($datos)==true and count($datos)==0 ){ //Si existe consulta(no eliminar)
    $pacientes->eliminar_paciente($_POST["id_paciente"]);
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
//fin 
  break;

///////LISTAR PACIENTES CON CONSULTA EN VENTAS
 case "listar_pacientes_consulta":

  $datos=$pacientes->get_pacientes_con_consulta($_POST["sucursal"]);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["id_consulta"];
    $sub_array[] = $row["nombres"];    
    $sub_array[] = $row["fecha_consulta"]; 
    $sub_array[] = $row["p_evaluado"];    

    $sub_array[] = '<button type="button" onClick="pacienteConsultaData('.$row["id_paciente"].','.$row["id_consulta"].');" id="'.$row["id_paciente"].'" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';            
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;

///////LISTAR PACIENTES PARA REFERIR EN EN VENTAS
 case "listar_pacientes_refiere":

  $datos=$pacientes->get_paciente_refieren();
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["id_paciente"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["sucursal"];
    $sub_array[] = '<button type="button" onClick="pacienteRefiereData('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';            
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;

///////LISTAR PACIENTES CON CONSULTA EN VENTAS
case "listar_pacientes_sin_consulta":

  $datos=$pacientes->get_pacientes_sin_consulta($_POST["sucursal"]);
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["id_paciente"];
    $sub_array[] = $row["codigo"];
    $sub_array[] = $row["nombres"];

    $sub_array[] = '<button type="button" onClick="pacienteSinConsultaData('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';            
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);


    break;

///////LISTAR PACIENTES QUE REFIEREN////////////////
case "listar_pacientes_refieren":

  $datos=$pacientes->get_pacientes_refieren();
  $data= Array();
  foreach($datos as $row){
    $sub_array = array();
    $sub_array[] = $row["id_paciente"];
    $sub_array[] = $row["nombres"];
    $sub_array[] = $row["telefono"];
    $sub_array[] = $row["sucursal"];
    $sub_array[] = '<button type="button" onClick="pacienteRefiere('.$row["id_paciente"].');" id="'.$row["id_paciente"].'" class="btn btn-md bg-success"><i class="fas fa-plus" aria-hidden="true" style="color:white"></i></button>';          
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);   

 break;

    ///GET DATA PACIENTES CON CONSULTAS EN VENTA
  case "buscar_data_pacientes_con_consulta_ventas":

   $datos= $pacientes->get_data_con_consulta($_POST["id_paciente"],$_POST["id_consulta"]);
    foreach($datos as $row){
      $output["codigo"] = $row["codigo"];
      $output["nombres"] = $row["nombres"];
      $output["p_evaluado"] = $row["p_evaluado"];
      $output["id_usuario"] = $row["id_usuario"];      
    }

      echo json_encode($output);

     break;

   ///GET DATA PACIENTES SINCONSULTAS EN VENTA
  case "buscar_data_pacientes_sin_consulta_ventas":

   $datos= $pacientes->get_data_sin_consulta($_POST["id_paciente"]);
    foreach($datos as $row){
      $output["codigo"] = $row["codigo"];
      $output["nombres"] = $row["nombres"];             
    }

      echo json_encode($output);

     break;

  case 'datos_pacientes_rec_ini':
    $datos= $pacientes->get_detalle_paciente_rec_ini($_POST["id_paciente"]); 

        if(is_array($datos)==true and count($datos)>0){
          foreach($datos as $row){         
            $output["telefono"] = $row["telefono"];
            $output["empresas"] = $row["empresas"];                          
          }       
        echo json_encode($output);

        } 
      break;


  case "buscar_data_pacientes_refieren":

   $datos= $pacientes->get_pacientes_refieren_data($_POST["id_paciente"]);
    foreach($datos as $row){
      $output["id_paciente"] = $row["id_paciente"];
      $output["nombres"] = $row["nombres"];   
    }
  echo json_encode($output);
  break;

}