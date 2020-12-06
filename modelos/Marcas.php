<?php 
require_once("../config/conexion.php");

class Marca extends conectar 
{//inicio de la clase

	public function registrar_marca($nom_marca){

		$conectar= parent::conexion();
		parent::set_names();
		$sql="insert into marca values(null,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $nom_marca);
		$sql->execute();
	}
/////////////////////VERIFICAR SI EXISTE MARCA
	public function valida_existencia_marca($nom_marca){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="SELECT*from marca WHERE marca=?";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $nom_marca);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}
//FIN class

}

 ?>