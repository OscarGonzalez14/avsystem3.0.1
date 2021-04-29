<?php 
require_once("config/conexion.php");

class Externos extends conectar
{//inicio de la clase



	public function get_categorias($sucursal){
	    $conectar= parent::conexion();
		parent::set_names();

	    $suscursal='';
  		$prefijo = substr($sucursal,0,3);
  		if ($prefijo =='Emp') {
    		$suscursal = substr($sucursal, 4,25);
  		}else{
    		$suscursal=$sucursal;
  		}  		
		$sql="select id_categoria, nombre from categoria where sucursal=?";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $suscursal);
    	$sql->execute();
    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    	}

	public function get_marca(){
		$conectar= parent::conexion();
		parent::set_names();
		$sql="select id_marca, marca from marca";
		$sql=$conectar->prepare($sql);
		$sql->execute();
		return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_categorias_suc($categoria,$sucursal){
	    $conectar= parent::conexion();
		parent::set_names();
		 $sql="select nombre from categoria where tipo_categoria=? and sucursal=?";
		 $sql=$conectar->prepare($sql);
		 $sql->bindValue(1, $categoria);
		 $sql->bindValue(2, $sucursal);
    	 $sql->execute();
    	 return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    	}

	}/////FIN CLASS

 ?>