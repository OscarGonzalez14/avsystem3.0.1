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

}