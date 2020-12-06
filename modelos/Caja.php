<?php
require_once("../config/conexion.php");

class Caja extends Conectar{

  public function get_numero_requisicion($sucursal){
    $conectar= parent::conexion();
    $sql = "select n_requisicion from requisicion where sucursal=? order by id_requisicion DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //////////// VALIDAMOS SI EXISTE REQUISICION /////////////
  public function valida_existe_requisicion($n_requisicion){

	$conectar = parent::conexion();

    $sql= "select * from requisicion where n_requisicion = ?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }

/////////////////////REGISTRA REQUISICION  //////////////

  public function agrega_det_requisicion(){

  	$str = '';
	$detalles = array();
	$detalles = json_decode($_POST['arrayRequisicion']);
	$conectar= parent::conexion();
	parent::set_names();

	foreach ($detalles as $k => $v) {
	  $descripcion = $v->descripcion;
      $cantidad = $v->cantidad;

      $fecha_req = $_POST["fecha_req"];
      $numero_req = $_POST["numero_req"];
      $usuario = $_POST["usuario"];
      $sucursal = $_POST["sucursal"];

      $sql="insert into detalle_requisicion values(null,?,?,?,'0',?,?,'No');";
      $sql=$conectar->prepare($sql);

    	$sql->bindValue(1,$numero_req);
    	$sql->bindValue(2,$descripcion);
    	$sql->bindValue(3,$cantidad);
    	$sql->bindValue(4,$usuario);
    	$sql->bindValue(5,$sucursal);
    	$sql->execute();
    
    }///////////////FIN FOREACH

    $estado = 0;
    $aprobado_por = "";

    $sql1="insert into requisicion values(null,?,?,?,?,?,?);";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_req);
    $sql1->bindValue(2,$fecha_req);
    $sql1->bindValue(3,$estado);
    $sql1->bindValue(4,$usuario);
    $sql1->bindValue(5,$aprobado_por);
    $sql1->bindValue(6,$sucursal);
    $sql1->execute();


  }
//////////////////LISTADO GENERAL DE REQUISICIONES
   public function get_requisiones($sucursal){
    $conectar= parent::conexion();
    $sql= "select*from requisicion where sucursal=? order by id_requisicion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //////////////////	REQUICISIONES PENDIENTES
   public function get_requisiones_pendiente(){
    $conectar= parent::conexion();
    $sql= "select*from requisicion where estado='0' order by id_requisicion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////// GET DATA ARRAY ADMIN 

    public function get_data_requisicion_admin($n_requisicion){
    $conectar= parent::conexion();         
    $sql= "select id_detalle_req,descripcion,cantidad,precio from detalle_requisicion where numero_requicision=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_detalles_req($n_requisicion){
    $conectar= parent::conexion();         
    $sql= "select * from detalle_requisicion where numero_requicision=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$n_requisicion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

////////////////////////////////APROBARREQUISICION

    public function aprobar_requisicion(){

    $str = '';
    $detalles = array();
    $detalles = json_decode($_POST['arrayAprobados']);
    $conectar= parent::conexion();
    parent::set_names();

  foreach ($detalles as $k => $v) {

    $estado = $v->estado;
    $cantidad = $v->cantidad;
    $id_detalle = $v->id_detalle;

    $usuario = $_POST["usuario"];
    $n_requisicion = $_POST["n_requisicion"];

    if ($estado=="Ok") {       
       $sql ="update detalle_requisicion set estado='Si', cantidad=? where id_detalle_req=?;";
       $sql =$conectar->prepare($sql);
       $sql->bindValue(1,$cantidad);
       $sql->bindValue(2,$id_detalle);
       $sql->execute();
    }
         
    }///////////////FIN FOREACH

    $sql1="update requisicion set aprobado_por=?,estado='1' where n_requisicion=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$usuario);
    $sql1->bindValue(2,$n_requisicion);
    $sql1->execute();

//print_r($_POST);
  }

}


