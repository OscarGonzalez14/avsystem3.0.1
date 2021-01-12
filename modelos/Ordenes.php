<?php  


require_once("../config/conexion.php");
class Ordenes extends Conectar{

	public function get_consultas_orden($sucursal){
     	$conectar= parent::conexion();       
     	$sql= "select p.id_paciente,p.nombres,p.empresas,c.fecha_consulta,c.p_evaluado,p.sucursal,c.id_consulta from pacientes as p inner join consulta as c  on c.id_paciente=p.id_paciente where p.sucursal=?;";
     	$sql=$conectar->prepare($sql);
     	$sql->bindValue(1,$sucursal);
     	$sql->execute();
     	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);         
    }
}