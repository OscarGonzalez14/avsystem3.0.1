<?php
require_once("../config/conexion.php");
//llamada al modelo marca
require_once("../modelos/Recibos.php");

$recibos = new Recibos();

switch ($_GET["op"]) {
  case 'get_detalle_lente_rec_ini':
     
  break;


///////////////////////GET NUMERO RECIBO
  case "get_numero_recibo":
  $datos= $recibos->get_numero_recibo($_POST["sucursal_correlativo"]);
  $sucursal = $_POST["sucursal_correlativo"];
  $prefijo = "";
  if ($sucursal=="Metrocentro") {
    $prefijo="ME";
  }elseif ($sucursal=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal=="San Miguel") {
    $prefijo="SM";
  }elseif($sucursal=="Emp-Metrocentro"){
    $prefijo == "EM";
  }elseif($sucursal=="Emp-San Miguel"){
    $prefijo == "ES";
  }elseif($sucursal=="Emp-Santa Ana"){
    $prefijo == "EA";
  }
    if(is_array($datos)==true and count($datos)>0){
    foreach($datos as $row){                  
      $codigo=$row["numero_recibo"];
      $cod=(substr($codigo,4,11))+1;
      $output["correlativo"]="R".$prefijo."-".$cod;
    }             
  }else{
      $output["correlativo"] = "R".$prefijo."-1";
  }

   echo json_encode($output);

  break;

  case 'registrar_recibo':

  $datos=$recibos->valida_existencia_nrecibo($_POST["n_recibo"]);
  if(is_array($datos)==true and count($datos)==0){

    $recibos->agrega_detalle_abono($_POST['a_anteriores'],$_POST['n_recibo'],$_POST['n_venta_recibo_ini'],$_POST['monto'],$_POST['fecha'],$_POST['sucursal'],$_POST['id_paciente'],$_POST['id_usuario'],$_POST['telefono_ini'],$_POST['recibi_rec_ini'],$_POST['empresa_ini'],$_POST['texto'],$_POST['numero'],$_POST['saldo'],$_POST['forma_pago'],$_POST['marca_aro_ini'],$_POST['modelo_aro_ini'],$_POST['color_aro_ini'],$_POST['lente_rec_ini'],$_POST['ar_rec_ini'],$_POST['photo_rec_ini'],$_POST['observaciones_rec_ini'],$_POST['pr_abono'],$_POST['servicio_rec_ini']);
      $messages[]="ok";
      
    }else{
      $errors[]="error";
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
   }else{
    $pacientes->editar_recibo($_POST["a_anteriores"],$_POST["n_recibo"],$_POST["n_venta_recibo_ini"],$_POST["monto"],$_POST["fecha"],$_POST["sucursal"],$_POST["id_paciente"],$_POST["id_usuario"],$_POST["telefono_ini"],$_POST["recibi_rec_ini"],$_POST["empresa_ini"],$_POST["texto"],$_POST["numero"],$_POST["saldo"],$_POST["forma_pago"],$_POST["marca_aro_ini"],$_POST["modelo_aro_ini"],$_POST["color_aro_ini"],$_POST["lente_rec_ini"],$_POST["ar_rec_ini"],$_POST["photo_rec_ini"],$_POST["observaciones_rec_ini"],$_POST["pr_abono"],$_POST["servicio_rec_ini"]);
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

  /////////////COMPROBAR SALDOS PARA IMPRIMIR FACTURA CONTADO
  case "consultar_saldo":
  $datos= $recibos->saldo_venta($_POST["n_venta"],$_POST["id_paciente"]);
  
    if(is_array($datos)==true and count($datos)>0){
      foreach($datos as $row){                  
        $output["saldo"]=$row["saldo"];
      }             
    }

   echo json_encode($output);

  break;

  case 'listar_recibos_emitidos':
    $datos=$recibos->get_recibos_emitidos($_POST["sucursal"]);
    //Vamos a declarar un array
    $data= Array();

    foreach($datos as $row){

        $sub_array = array();

        $sub_array[] = $row["id_recibo"];
        $sub_array[] = $row["numero_recibo"];
        $sub_array[] = $row["numero_venta"];
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["servicio_para"];
        $sub_array[] = '<button type="button" style="text-align:center" onClick="show_datos_recibo("'.$row["id_recibo"].',\''.$row["numero_recibo"].'\',\''.$row["numero_venta"].',\''.$row["id_paciente"].'\');" data-toggle="modal" data-target="#modal_recibos_generico" data-backdrop="static" class="btn btn-light btn-md bg-white" data-keyboard="false"><i class="fa fa-edit" aria-hidden="true" style="color:#006600"></i></button>';
        $sub_array[] = '<a href="imprimir_recibo_pdf.php?n_recibo='.$row["numero_recibo"].'&'."n_venta=".$row["numero_venta"].'&'."id_paciente=".$row["id_paciente"].'&'."sucursal=".$row["sucursal"].'" method="POST" target="_blank"><button type="button" class="btn btn-link btn-md bg-white"><i class="fa fa-print" aria-hidden="true" style="color:green"></i></button></a>';
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);      
    break;


/////////////////////LISTAR CVREDITOS EMPRESARIALES
    case 'listar_creditos_empresariales':
    $datos=$recibos->get_creditos_empresarial($_POST["empresa"]);
    $data= Array();
    $i=0;
    foreach($datos as $row){
        $sub_array = array();
        $sub_array[] = '<input type="checkbox" class="form-check-input selectPacienteOid" value="'.$row["id_paciente"].'" name="'.$row["numero_venta"].'" id="oid_correlativo'.$i.'"><span style="color:white">.</span>';
        $sub_array[] = $row["nombres"];
        $sub_array[] = $row["evaluado"];
        $sub_array[] = $row["empresas"];
        $sub_array[] = "$".number_format($row["monto"],2,".",",");
        $sub_array[] = "$".number_format($row["saldo"],2,".",",");
        $data[] = $sub_array;
        $i++;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
      echo json_encode($results);      
    break;

    case 'get_numero_orden_cobro':

    $datos = $recibos->get_numero_orden_cobro();

    if (is_array($datos)==true and count($datos)>0) {
      foreach ($datos as $row) {
        $cod = $row["numero_orden"];
        $cod = (substr($cod, 3,11))+1;
        $output["correlativo"] = "OC-".$cod;
      }
    }else{
      $output["correlativo"] = "OC-1";
    }

    echo json_encode($output);

    break;


case 'registrar_orden_cobro':

$datos=$recibos->valida_existencia_oc($_POST["numero_orden"]);

if(is_array($datos)==true and count($datos)==0){
  $recibos->agrega_detalle_orden_credito();
  $messages[]="ok";

}else{
  $errors[]="error";
}

      if (isset($messages)){ ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
      <?php
      }

      if (isset($errors)){ ?>
         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
      <?php
   }

  break;

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


case "listar_ordenes_cobro":

  $datos=$recibos->get_ordenes_cobro();
  $data= Array();
  $estado = "";
  foreach($datos as $row){

    if ($row["estado"]==0) {
      $estado="Pendiente";
    }elseif($row["estado"]==1){
      $estado = "Finalizado";
    }
    $sub_array = array();
    $sub_array[] = $row["id_orden"];
    $sub_array[] = $row["numero_orden"];
    $sub_array[] = strtoupper($row["usuario"]);    
    $sub_array[] = $row["fecha"]; 
    $sub_array[] = $row["empresa"];
    $sub_array[] = "$".number_format((float)$row["monto"],2,".",",");  
    $sub_array[] = $estado;  
    $sub_array[] = '<button type="button" class="btn btn-md bg-primary" onClick="showDetallesOc('.$row["id_orden"].',\''.$row["numero_orden"].'\',\''.$row["empresa"].'\');"><i class="fas fa-cog" aria-hidden="true" style="color:white"></i></button>';            
                                                
    $data[] = $sub_array;
  }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;

    //////////////////GET DETALLES ORDEN COBRO

  case 'get_detalle_pacientes_oc':
   $datos = $recibos->get_detalle_pacientes_oc($_POST["empresa"],$_POST["numero_orden"]);
   if (is_array($datos)==true and count($datos)>0) {
      $data = Array();
      foreach($datos as $row){
        $output = array();
        $output["numero_orden"] = $row["numero_orden"];
        $output["numero_recibo"] = $row["numero_recibo"];
        $output["id_paciente"] = $row["id_paciente"];
        $output["monto_abono"] = $row["monto_abono"];
        $output["numero_venta"] = $row["numero_venta"];
        $output["nombres"] = $row["nombres"];
        $output["empresas"] = $row["empresas"];
        $data[]= $output;
      }
   }
   echo json_encode($data);
  break;

  case 'confirmar_orden_cobro':

  $recibos->confirmar_orden_cobro();
  $messages[]="ok";


      if (isset($messages)){ ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
      <?php
      }

      if (isset($errors)){ ?>
         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
      <?php
   }

  break;

     ///////////////BUSCAR NUMERO DE RECIBO VISUALIZAR LA INFORMACION
    case 'ver_recibo_data':    
    $datos=$recibos->get_recibo_por_num($_POST["sucursal"]);
      foreach($datos as $row)
      {
      $output["sucursal"] = $row["sucursal"];   
      }
    echo json_encode($output);
    break;

    /////////////////SHOW DATOS EN LA MODAL RECIBOS PARA EDITAR
  case 'show_datos_recibo':

    $datos=$recibos->show_datos_recibo($_POST["id_paciente"],$_POST["id_credito"],$_POST["numero_venta"]);

      foreach($datos as $row){

      $output["recibi_de"] = $row["recibi_de"];
      $output["servicio_para"] = $row["servicio_para"];
      $output["telefono"] = $row["telefono"];
      $output["empresa"] = $row["empresa"];
      $output["cant_letras"] = $row["cant_letras"];
      $output["pr_abono_ini"] = $row["pr_abono_ini"];
      $output["monto"] = $row["monto"];
      $output["abono_ant"] = $row["abono_ant"];
      $output["saldo"] = $row["saldo"];
      $output["numero"] = $row["numero"];
      $output["saldo"] = $row["saldo"];
      $output["forma_pago"] = $row["forma_pago"];
      $output["prox_abono"] = $row["prox_abono"];
      $output["marca_aro"] = $row["marca_aro"];
      $output["modelo_aro"] = $row["modelo_aro"];
      $output["color_aro"] = $row["color_aro"];
      $output["lente"] = $row["lente"];
      $output["photo"] = $row["photo"];
      $output["anti_r"] = $row["anti_r"];
      $output["observaciones"] = $row["observaciones"];
      $output["id_paciente"] = $row["id_paciente"];
      $output["numero_venta"] = $row["numero_venta"];

      }
    echo json_encode($output);
  break;



}