<?php 
require_once("../config/conexion.php");

class Empresas extends conectar{//inicio de la clase

	public function registrarEmpresa($nomEmpresa,$dirEmpresa,$nitEmpresa,$telEmpresa,$respEmpresa,$correoEmpresa,$encargado,$registro,$giro){

		$conectar= parent::conexion();
		parent::set_names();
		$sql="insert into empresas values(null,?,?,?,?,?,?,?,?,?);";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $nomEmpresa);
		$sql->bindValue(2, $dirEmpresa);
		$sql->bindValue(3, $nitEmpresa);
		$sql->bindValue(4, $telEmpresa);
		$sql->bindValue(5, $respEmpresa);
		$sql->bindValue(6, $correoEmpresa);
		$sql->bindValue(7, $encargado);
    $sql->bindValue(8, $registro);
    $sql->bindValue(9, $giro);

		$sql->execute();

		//print_r($_POST);
	}


	public function get_empresas_en_pacientes(){

          $conectar=parent::conexion();
          parent::set_names();
          $sql="select id_empresa, nombre,ubicacion from empresas";
          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_empresa_paciente($id_empresa){
    $conectar= parent::conexion();
    //$output = array();
    $sql="select id_empresa,nombre from empresas where id_empresa=?";

    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_empresa);
    $sql->execute();

    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }
///////////////////////GET DATA VENTA CREDITO FISCAL
  public function get_contribuyentes(){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select p.nombres,p.id_paciente,e.nombre as empresa,e.ubicacion,e.nit from pacientes as p join empresas as e where p.empresas=e.nombre ORDER BY p.id_paciente;";
  $sql=$conectar->prepare($sql);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

}/////FIN CLASS

 ?>

