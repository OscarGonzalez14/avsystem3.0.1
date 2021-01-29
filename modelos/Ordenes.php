<?php

require_once("../config/conexion.php");
class Ordenes extends Conectar{

	public function get_consultas_orden($sucursal){
     	$conectar= parent::conexion();       
     	$sql= "select p.id_paciente,p.nombres,p.empresas,c.fecha_consulta,c.p_evaluado,p.sucursal,c.id_consulta from pacientes as p inner join consulta as c  on c.id_paciente=p.id_paciente where p.sucursal=? order by c.id_consulta DESC;";
     	$sql=$conectar->prepare($sql);
     	$sql->bindValue(1,$sucursal);
     	$sql->execute();
     	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);         
    }

    public function get_numero_venta($id_paciente,$evaluado){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select numero_venta from ventas where id_paciente=? and evaluado=? order by id_ventas DESC limit 1";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$evaluado);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

    public function get_items_venta($id_paciente,$numero_venta){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select id_producto from detalle_ventas where id_paciente=? and numero_venta=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$numero_venta);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

    public function get_categoria_producto($codProd){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select categoria_producto from productos where id_producto=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$codProd);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
////////////GET NUMERO DE PACIENTE POR SUCURSAL
public function get_numero_orden_lab($sucursal){
    $conectar= parent::conexion();
    $sql= "select numero_orden from envios_lab where sucursal=? order by id_envio DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


public function buscar_existe_orden($numero_orden){
    $conectar= parent::conexion();
    $sql= "select*from envios_lab where numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function registrar_orden($paciente_orden,$laboratorio_orden,$id_pac_orden,$id_consulta_orden,$lente_orden,$tratamiento_orden,$modelo_aro_orden,$marca_aro_orden,$color_aro_orden,$diseno_aro_orden,$med_a,$med_b,$med_c,$med_d,$observaciones_orden,$id_usuario,$fecha,$sucursal,$numero_orden,$prioridad_orden){
    $conectar= parent::conexion();
    $estado="0";
    $sql="insert into envios_lab values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->bindValue(2,$laboratorio_orden);
    $sql->bindValue(3,$id_pac_orden);
    $sql->bindValue(4,$paciente_orden);
    $sql->bindValue(5,$id_consulta_orden);
    $sql->bindValue(6,$lente_orden);
    $sql->bindValue(7,$tratamiento_orden);
    $sql->bindValue(8,$modelo_aro_orden);
    $sql->bindValue(9,$color_aro_orden);
    $sql->bindValue(10,$marca_aro_orden);
    $sql->bindValue(11,$diseno_aro_orden);
    $sql->bindValue(12,$id_usuario);
    $sql->bindValue(13,$med_a);
    $sql->bindValue(14,$med_b);
    $sql->bindValue(15,$med_c);
    $sql->bindValue(16,$med_d);
    $sql->bindValue(17,$fecha);
    $sql->bindValue(18,$estado);
    $sql->bindValue(19,$observaciones_orden);
    $sql->bindValue(20,$sucursal);
    $sql->bindValue(21,$prioridad_orden);
    $sql->execute();

}

/////////////DATATABLE ORDENES
public function listar_ordenes($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.laboratorio,e.evaluado,e.fecha_creacion,u.usuario,e.estado,id_paciente,e.sucursal from envios_lab as e inner join usuarios as u on e.id_usuario=u.id_usuario where e.sucursal=? and e.estado='0';";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
   ####ordenes Enviadas
public function listar_ordenes_enviadas($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.evaluado,e.estado,e.prioridad,p.nombres,p.id_paciente,a.tipo_accion,a.fecha,e.prioridad from envios_lab as e inner join pacientes as p on e.id_paciente=p.id_paciente join acciones_ordenes_lab as a where e.numero_orden=a.n_orden and a.tipo_accion='Envio a laboratorio' and e.sucursal=? and e.estado='1'order by e.id_envio DESC;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}
######### Ordenes recibidas
public function listar_ordenes_recibidas($sucursal){
    $conectar = parent::conexion();
    $sql = "select e.id_envio,e.numero_orden,e.evaluado,e.estado,e.prioridad,p.nombres,p.id_paciente,a.tipo_accion,a.fecha,u.usuario from envios_lab as e inner join pacientes as p on e.id_paciente=p.id_paciente join acciones_ordenes_lab as a
    inner join usuarios as u on a.id_usuario=u.id_usuario where e.numero_orden=a.n_orden and a.tipo_accion='Recibir de laboratorio' and e.sucursal=? and e.estado='2'order by e.id_envio DESC;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();    
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////ENVIAR ORDEN DE LABORATORIO
public function enviar_orden_lab(){

$conectar = parent::conexion();
parent::set_names();
////UPDATE ESTADO DE ORDEN
$detalles_envio = array();
$detalles_envio = json_decode($_POST["arrayEnvio"]);
$tipo_accion = $_POST["tipo_accion"];
$id_usuario = $_POST["id_usuario"];
$sucursal = $_POST["sucursal"];

foreach($detalles_envio as $k => $v){
    $id_paciente = $v->id_paciente;
    $numero_orden = $v->numero_orden;

//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='1' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();


///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

}//Fin Foreach
}


//////////////RECIBIR ORDEN DE LABORATORIO
public function recibir_orden_lab(){

$conectar = parent::conexion();
parent::set_names();
////UPDATE ESTADO DE ORDEN
$detalles_recibir = array();
$detalles_recibir = json_decode($_POST["arrayRecibir"]);
$tipo_accion = $_POST["tipo_accion"];
$id_usuario = $_POST["id_usuario"];
$sucursal = $_POST["sucursal"];

foreach($detalles_recibir as $k => $v){
    $id_paciente = $v->id_paciente;
    $numero_orden = $v->numero_orden;

//////////////GET DETALLES DE LA ORDEN/////////////
   $sql3 = "select*from envios_lab where id_paciente=? and numero_orden=?";
   $sql3=$conectar->prepare($sql3);
   $sql3->bindValue(1,$id_paciente);
   $sql3->bindValue(2,$numero_orden);
   $sql3->execute();
   $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
   foreach ($resultados as $row) {
       $evaluado = $row["evaluado"];
       $laboratorio = $row["laboratorio"];
   }

   $sql1="update envios_lab set estado='2' where numero_orden=? and id_paciente=? and evaluado=?;";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$numero_orden);
    $sql1->bindValue(2,$id_paciente);
    $sql1->bindValue(3,$evaluado);
    $sql1->execute();


///////INSERT INTO ACCIONES LAB
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$sql="insert into acciones_ordenes_lab values(null,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$tipo_accion);
$sql->bindValue(2,$hoy);
$sql->bindValue(3,$id_usuario);
$sql->bindValue(4,$numero_orden);
$sql->bindValue(5,$laboratorio);
$sql->bindValue(6,$id_paciente);
$sql->bindValue(7,$evaluado);
$sql->bindValue(8,$sucursal);
$sql->execute();

}//Fin Foreach
}

}