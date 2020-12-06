<?php 
require_once("../config/conexion.php");

	class Accesorios extends conectar{
	//inicio de la clase

	public function registrar_accesorios($marca_accesorio,$des_accesorio,$tipo_accesorio){

		$conectar= parent::conexion();
		parent::set_names();
		$sql="insert into accesorios values(null,?,?,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $marca_accesorio);
		$sql->bindValue(2, $des_accesorio);
		$sql->bindValue(3, $tipo_accesorio);

		$sql->execute();

		//print_r($_POST);
	}

	

	}/////FIN CLASS

 ?>