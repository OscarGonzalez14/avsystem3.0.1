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
}