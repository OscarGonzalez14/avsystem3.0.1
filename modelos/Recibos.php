<?php 
require_once("../config/conexion.php");

class Recibos extends conectar {//inicio de la clase


  public function get_numero_recibo($sucursal_correlativo){
    $conectar= parent::conexion();
    $sql= "select numero_recibo from recibos where sucursal=? order by id_recibo DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal_correlativo);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_datos_pac_rec_ini($n_venta,$id_paciente){

    $conectar= parent::conexion();         
  $sql= "select p.categoria_producto,d.producto from productos as p inner join detalle_ventas as d on p.id_producto=d.id_producto where categoria_producto='lentes'
        and d.numero_venta=? and d.id_paciente=?";

    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->bindValue(2, $id_usuario);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////VALIDA NUMERO DE RECIBO
///////////////VERIFICA SI EXISTE RECIBO***********
public function valida_existencia_nrecibo($n_recibo){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select numero_recibo from recibos where numero_recibo=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $n_recibo);
  $sql->execute();
  return $resultado=$sql->fetchAll();
}
///////////////////GREGISTRA RECIBO
public function agrega_detalle_abono($a_anteriores,$n_recibo,$n_venta_recibo_ini,$monto,$fecha,$sucursal,$id_paciente,$id_usuario,$telefono_ini,$recibi_rec_ini,$empresa_ini,$texto,$numero,$saldo,$forma_pago,$marca_aro_ini,$modelo_aro_ini,$color_aro_ini,$lente_rec_ini,$ar_rec_ini,$photo_rec_ini,$observaciones_rec_ini,$pr_abono,$servicio_rec_ini){

$conectar=parent::conexion();  

  $sql="insert into recibos values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);

  $sql->bindValue(1,$n_recibo);
  $sql->bindValue(2,$n_venta_recibo_ini);
  $sql->bindValue(3,$monto);
  $sql->bindValue(4,$fecha);
  $sql->bindValue(5,$sucursal);
  $sql->bindValue(6,$id_paciente);
  $sql->bindValue(7,$id_usuario);
  $sql->bindValue(8,$telefono_ini);
  $sql->bindValue(9,$recibi_rec_ini);
  $sql->bindValue(10,$empresa_ini);
  $sql->bindValue(11,$texto);
  $sql->bindValue(12,$a_anteriores);
  $sql->bindValue(13,$numero);
  $sql->bindValue(14,$saldo);
  $sql->bindValue(15,$forma_pago);
  $sql->bindValue(16,$marca_aro_ini);
  $sql->bindValue(17,$modelo_aro_ini);
  $sql->bindValue(18,$color_aro_ini);
  $sql->bindValue(19,$lente_rec_ini);
  $sql->bindValue(20,$ar_rec_ini);
  $sql->bindValue(21,$photo_rec_ini);
  $sql->bindValue(22,$observaciones_rec_ini);
  $sql->bindValue(23,$pr_abono);
  $sql->bindValue(24,$servicio_rec_ini);
  
  $sql->execute();

  ///////////////REGISTRA ABONOS
  $sql2="insert into abonos values(null,?,?,?,?,?,?,?,?);";
  $sql2=$conectar->prepare($sql2);
  $sql2->bindValue(1,$numero);
  $sql2->bindValue(2,$forma_pago);
  $sql2->bindValue(3,$fecha);
  $sql2->bindValue(4,$id_paciente);
  $sql2->bindValue(5,$id_usuario);
  $sql2->bindValue(6,$n_recibo);
  $sql2->bindValue(7,$n_venta_recibo_ini);
  $sql2->bindValue(8,$sucursal);
  $sql2->execute();

  ///////////////ACTUALIZAR SALDO DEL CREDITO
  $sql3="select * from creditos where numero_venta=? AND id_paciente=?;";             
  $sql3=$conectar->prepare($sql3);
  $sql3->bindValue(1,$n_venta_recibo_ini);
  $sql3->bindValue(2,$id_paciente);
  $sql3->execute();

  $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultados as $b=>$row){
      $re["saldo_actual"] = $row["saldo"];
      $re["tipo_credito"] = $row["tipo_credito"];
  }
    //la cantidad total es la suma de la cantidad más la cantidad actual
    $saldo_act = $row["saldo"] - $numero;
    $forma_venta =$row["tipo_credito"];
            
      if(is_array($resultados)==true and count($resultados)>0) {                     
      //actualiza el stock en la tabla producto
        $sql12 = "update creditos set saldo=? where numero_venta=? and id_paciente=?";
        $sql12 = $conectar->prepare($sql12);
        $sql12->bindValue(1,$saldo_act);
        $sql12->bindValue(2,$n_venta_recibo_ini);
        $sql12->bindValue(3,$id_paciente);
        //$sql12->bindValue(3,$sucursal);
        $sql12->execute();               
    }//Fin del if

  ///////////RECORD CORTE DIARIO

  //*************Clasificar por numero de abonos si es venta o recuperado si el numeor de abonos es >0
  $sql15="select count(numero_venta) as cuenta from abonos where numero_venta=? and id_paciente=?;";
             
    $sql15=$conectar->prepare($sql15);
    $sql15->bindValue(1,$n_venta_recibo_ini);
    $sql15->bindValue(2,$id_paciente);
    $sql15->execute();

    $suma_res=0;
    $resultado_num_ventas = $sql15->fetchAll(PDO::FETCH_ASSOC);
      foreach($resultado_num_ventas as $b=>$row){
      $suma_res = $suma_res+$row["cuenta"];        

    }

//print_r($suma_res);exit;
//****************Seleccionar abono Anterior
  $sql16="select sum(monto_abono) as monto_abono from abonos where numero_venta=? and id_paciente=?;";
             
    $sql16=$conectar->prepare($sql16);
    $sql16->bindValue(1,$n_venta_recibo_ini);
    $sql16->bindValue(2,$id_paciente);

    $sql16->execute();

    $suma_abonos_ant='0';
    $resultado_abonos = $sql16 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($resultado_abonos as $b=>$row){
        $suma_abonos_ant = $suma_abonos_ant+$row["monto_abono"];        

    }
/////////////////////EXTRAER EL TIPO DE PAGO
    $sql19="select * from ventas where numero_venta=? and id_paciente=?;";             
    $sql19=$conectar->prepare($sql19);
    $sql19->bindValue(1,$n_venta_recibo_ini);
    $sql19->bindValue(2,$id_paciente);
    $sql19->execute();
    
    $ver_tipo_pago = $sql19 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($ver_tipo_pago as $b=>$row){
      $tipo_pago = $row["tipo_pago"];
      $tipo_venta = $row["tipo_venta"];
      $fecha_venta = substr($row["fecha_venta"],0,10);
    }
  ///////////////verificar abonos realizados de venta en corte
    $sql21="select * from corte_diario where n_venta=? and id_paciente=?;";
             
    $sql21=$conectar->prepare($sql21);
    $sql21->bindValue(1,$n_venta_recibo_ini);
    $sql21->bindValue(2,$id_paciente);
    $sql21->execute();
    
    $abonos_realizados = $sql21 ->fetchAll(PDO::FETCH_ASSOC);
      foreach($abonos_realizados as $b=>$row){
      $total_abonos = $row["abonos_realizados"];
      $fecha_ing = $row["fecha_ingreso"];
      
    }

  $fecha_ingr = substr($fecha_ing, 0,10);
  date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y");

/* if (($fecha_ingr != $hoy and $suma_res==1) or ($fecha_ingr == $fecha_venta and $suma_res>1)){
  $tipo_ingreso = "Recuperado";
  $factura = "";
  $sql17="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $sql17=$conectar->prepare($sql17);
  $sql17->bindValue(1,$fecha);
  $sql17->bindValue(2,$n_recibo);
  $sql17->bindValue(3,$n_venta_recibo_ini);
  $sql17->bindValue(4,$factura);
  $sql17->bindValue(5,$recibi_rec_ini);
  $sql17->bindValue(6,$id_usuario);
  $sql17->bindValue(7,$monto);
  $sql17->bindValue(8,$forma_pago);
  $sql17->bindValue(9,$numero);
  $sql17->bindValue(10,$saldo);
  $sql17->bindValue(11,$tipo_venta);
  $sql17->bindValue(12,$tipo_pago);
  $sql17->bindValue(13,$id_usuario);
  $sql17->bindValue(14,$suma_abonos_ant-$numero);
  $sql17->bindValue(15,$suma_res);
  $sql17->bindValue(16,$id_paciente);
  $sql17->bindValue(17,$sucursal);
  $sql17->bindValue(18,$sucursal);
  $sql17->bindValue(19,$tipo_ingreso);
  $sql17->execute();
  }else{
    $tipo_ingreso = "Venta";
    $factura='';
    $sql6="update corte_diario set forma_cobro=?,monto_cobrado=?,n_recibo=?,sucursal_cobro=?,saldo_credito=?,tipo_ingreso=? where id_paciente=? and n_venta=?;";
    $sql6=$conectar->prepare($sql6);
    $sql6->bindValue(1,$forma_pago);
    $sql6->bindValue(2,$numero);
    $sql6->bindValue(3,$n_recibo);
    $sql6->bindValue(4,$sucursal);
    $sql6->bindValue(5,$saldo);
    $sql6->bindValue(6,$tipo_ingreso);
    $sql6->bindValue(7,$id_paciente);
    $sql6->bindValue(8,$n_venta_recibo_ini);
    $sql6->execute();           
  
  
  
  }*/
    if ($fecha_ingr==$fecha_venta and $suma_res==1) {
    $tipo_ingreso = "Venta";
    $factura='';
    $sql6="update corte_diario set forma_cobro=?,monto_cobrado=?,n_recibo=?,sucursal_cobro=?,saldo_credito=?,tipo_ingreso=? where id_paciente=? and n_venta=?;";
    $sql6=$conectar->prepare($sql6);
    $sql6->bindValue(1,$forma_pago);
    $sql6->bindValue(2,$numero);
    $sql6->bindValue(3,$n_recibo);
    $sql6->bindValue(4,$sucursal);
    $sql6->bindValue(5,$saldo);
    $sql6->bindValue(6,$tipo_ingreso);
    $sql6->bindValue(7,$id_paciente);
    $sql6->bindValue(8,$n_venta_recibo_ini);
    $sql6->execute();           
  
  }elseif(($fecha_ingr==$fecha_venta and $suma_res>1) or ($fecha_ingr!=$fecha_venta)){
  
  $tipo_ingreso = "Recuperado";
  $factura = "";

  $sql17="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $sql17=$conectar->prepare($sql17);
  $sql17->bindValue(1,$fecha);
  $sql17->bindValue(2,$n_recibo);
  $sql17->bindValue(3,$n_venta_recibo_ini);
  $sql17->bindValue(4,$factura);
  $sql17->bindValue(5,$recibi_rec_ini);
  $sql17->bindValue(6,$id_usuario);
  $sql17->bindValue(7,$monto);
  $sql17->bindValue(8,$forma_pago);
  $sql17->bindValue(9,$numero);
  $sql17->bindValue(10,$saldo);
  $sql17->bindValue(11,$tipo_venta);
  $sql17->bindValue(12,$tipo_pago);
  $sql17->bindValue(13,$id_usuario);
  $sql17->bindValue(14,$suma_abonos_ant-$numero);
  $sql17->bindValue(15,$suma_res);
  $sql17->bindValue(16,$id_paciente);
  $sql17->bindValue(17,$sucursal);
  $sql17->bindValue(18,$sucursal);
  $sql17->bindValue(19,$tipo_ingreso);

  $sql17->execute();
  }

}
///////////////VERIFICA SALDO***********
public function saldo_venta($n_venta,$id_paciente){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select saldo from creditos where numero_venta=? and id_paciente=?";
  $sql= $conectar->prepare($sql);
  $sql->bindValue(1, $n_venta);
  $sql->bindValue(2, $id_paciente);
  $sql->execute();
  //return $resultado=$sql->fetchAll();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
////////LISTA RECIBOS EMITIDOS
public function get_recibos_emitidos($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select r.id_recibo,r.sucursal,r.numero_recibo,r.numero_venta,p.id_paciente,p.nombres,r.servicio_para from recibos as r inner join pacientes as p on p.id_paciente = r.id_paciente where r.sucursal=? order by r.id_recibo DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


////////////////GET CREDITOS PARA ABONOS POR LOTE

public function get_creditos_empresarial($empresa){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select p.nombres,p.empresas,c.monto,c.saldo,c.fecha_adquirido,c.id_paciente,c.numero_venta,v.evaluado from pacientes as p inner join creditos as c on p.id_paciente=c.id_paciente INNER JOIN ventas as v on c.numero_venta=v.numero_venta where  c.forma_pago='Descuento en Planilla' and p.empresas=? and c.saldo>0 order by p.id_paciente DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

  public function get_numero_orden_cobro(){

    $conectar= parent::conexion();
    $sql= "select numero_orden from orden_cobro order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  
  }

public function valida_existencia_oc($numero_orden){

    $conectar = parent::conexion();
    $sql= "select * from orden_cobro where numero_orden = ?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

 
}


public function agrega_detalle_orden_credito(){

  $conectar= parent::conexion();
  parent::set_names();
  
  date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y");
  $numero_orden = $_POST["numero_orden"];
  $usuario = $_POST["usuario"];
  $id_usuario = $_POST["id_usuario"];
  $empresa = $_POST["empresa"];
  $monto_total = $_POST["monto_total"];
  $suc_emp = "Empresarial";

  $str = '';
  $detalles = array();
  $detalles = json_decode($_POST['arrayOrdenCobro']);

  foreach ($detalles as $k => $v) {
      $abono_act = $v->abono_act;
      $empresa = $v->empresa;
      $id_paciente = $v->id_paciente;
      $monto = $v->monto;
      $nuevo_saldo = $v->nuevo_saldo;
      $numero_venta = $v->numero_venta;
      $pacientes = $v->pacientes;
      $plazo = $v->plazo;
      $saldo = $v->saldo;
      $subtotal = $v->subtotal;
 
      /////////////// GET NUMERO RECIBO
      $sql= "select numero_recibo from recibos where sucursal = 'Empresarial' order by id_recibo DESC limit 1;";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      $correlativos = $sql->fetchAll(PDO::FETCH_ASSOC);

      if (is_array($correlativos)==true and count($correlativos)>0){          
          foreach ($correlativos as $row) {
            $codigo=$row["numero_recibo"];
            $cod=(substr($codigo,4,11))+1;
            $correlativo = "EMP-".$cod;
          }
      }else{
          $correlativo = "EMP-1";
      }

      //////////////// get datos pacientes /////

    $sql2 = "select nombres,empresas,telefono from pacientes where id_paciente=?;";
    $sql2=$conectar->prepare($sql2);
    $sql2->bindValue(1,$id_paciente);
    $sql2->execute();
    $paciente = $sql2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($paciente as $row){
      $name_pac = $row["nombres"];
      $tel_pac = $row['telefono'];
      $empresas = $row['empresas'];
    }

    $cant_letras="";
    $a_anteriores="";
    $forma_pago="";
    $marca_aro="";
    $modelo_aro="";
    $color_aro="";
    $lente="";
    $anti_r="";
    $photo="";
    $observaciones="";
    $prox_abono="";
    $estado = '0';

    $sql4="insert into recibos values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql4=$conectar->prepare($sql4);
    $sql4->bindValue(1,$correlativo);
    $sql4->bindValue(2,$numero_venta);
    $sql4->bindValue(3,$monto);
    $sql4->bindValue(4,$hoy);
    $sql4->bindValue(5,$suc_emp);
    $sql4->bindValue(6,$id_paciente);
    $sql4->bindValue(7,$id_usuario);
    $sql4->bindValue(8,$tel_pac);
    $sql4->bindValue(9,$name_pac);
    $sql4->bindValue(10,$empresas);
    $sql4->bindValue(11,$cant_letras);
    $sql4->bindValue(12,$a_anteriores);
    $sql4->bindValue(13,$abono_act);
    $sql4->bindValue(14,$nuevo_saldo);
    $sql4->bindValue(15,$forma_pago);
    $sql4->bindValue(16,$marca_aro);
    $sql4->bindValue(17,$modelo_aro);
    $sql4->bindValue(18,$color_aro);
    $sql4->bindValue(19,$lente);
    $sql4->bindValue(20,$anti_r);
    $sql4->bindValue(21,$photo);
    $sql4->bindValue(22,$observaciones);
    $sql4->bindValue(23,$prox_abono);
    $sql4->bindValue(24,$name_pac);  
    $sql4->execute();

    ///////////////// INSERTAR EN DETALLE ORDEN COBRO ///////////
    $comprobante = '';
    $sql5 = "insert into detalle_orden_cobro values(null,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql5 = $conectar->prepare($sql5);
    $sql5->bindValue(1,$numero_orden);
    $sql5->bindValue(2,$correlativo);
    $sql5->bindValue(3,$id_usuario);
    $sql5->bindValue(4,$id_paciente);
    $sql5->bindValue(5,$abono_act);
    $sql5->bindValue(6,$numero_venta);
    $sql5->bindValue(7,$hoy);
    $sql5->bindValue(8,$estado);
    $sql5->bindValue(9,$monto);
    $sql5->bindValue(10,$nuevo_saldo);
    $sql5->bindValue(11,$saldo);
    $sql5->bindValue(12,$empresa);
    $sql5->bindValue(13,$comprobante);
    $sql5->execute();

  }//Fin recorrer detalles
////////////////GET DATOS VENTA /////
  $estado="0";
  $forma_cobro ="Null";
  date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y");
  $notas = "Null";

  $sql = "insert into orden_cobro values(null,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->bindValue(2,$usuario);
    $sql->bindValue(3,$id_usuario);
    $sql->bindValue(4,$hoy);
    $sql->bindValue(5,$empresa);
    $sql->bindValue(6,$monto_total);
    $sql->bindValue(7,$forma_cobro);
    $sql->bindValue(8,$notas);
    $sql->bindValue(9,$estado);

    $sql->execute();
}


  public function get_ordenes_cobro(){
    $conectar= parent::conexion();
    $sql= "select*from orden_cobro where estado='0' order by id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

  public function get_detalle_pacientes_oc($empresa,$numero_orden){
    $conectar= parent::conexion();
    $sql= "select p.nombres,p.id_paciente,p.empresas,o.numero_orden,o.numero_recibo,o.monto_abono,o.numero_venta,o.monto_credito from pacientes as p inner join detalle_orden_cobro as o on p.id_paciente=o.id_paciente where o.numero_orden=? and o.empresa=? AND p.empresas=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_orden);
    $sql->bindValue(2,$empresa);
    $sql->bindValue(3,$empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

public function confirmar_orden_cobro(){

  $conectar= parent::conexion();
  parent::set_names();

  date_default_timezone_set('America/El_Salvador');$hoy = date("d-m-Y");
  $tipo_pago_oc = $_POST["tipo_pago_oc"];
  $forma_abono = $_POST["forma_abono"];
  $comprobante_oc = $_POST["comprobante_oc"];
  $monto_oc = $_POST["monto_oc"];
  $sucursal_oc = 'Empresarial';
  $id_usuario = $_POST['id_usuario'];


  $str = '';
  $odc = array();
  $odc = json_decode($_POST['arrayODC']);

  foreach ($odc as $k => $v) {
   
   $comprobante = $v->comprobante;
   $empresas = $v->empresas;
   $estado = $v->estado;
   $monto_abono = $v->monto_abono;
   $nombres = $v->nombres;
   $numero_orden = $v->numero_orden;
   $numero_recibo = $v->numero_recibo;
   $numero_venta = $v->numero_venta;
   $id_paciente = $v->id_paciente;
  


   if($forma_abono=='Individual'){
    $comprobante_odc = $comprobante;
   }else{
    $comprobante_odc = $comprobante_oc;
   }

   if($estado === 'Ok'){  

  $sql3="select * from creditos where numero_venta=? AND id_paciente=?;";             
  $sql3=$conectar->prepare($sql3);
  $sql3->bindValue(1,$numero_venta);
  $sql3->bindValue(2,$id_paciente);
  $sql3->execute();

  $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultados as $b=>$row){
      $re["saldo_actual"] = $row["saldo"];
      $re["tipo_credito"] = $row["tipo_credito"];
  }
    //la cantidad total es la suma de la cantidad más la cantidad actual
    $saldo_act = $row["saldo"] - $monto_abono;
    $forma_venta =$row["tipo_credito"];
            
      if(is_array($resultados)==true and count($resultados)>0) {                     
      //actualiza el stock en la tabla producto
        $sql12 = "update creditos set saldo=? where numero_venta=? and id_paciente=?";
        $sql12 = $conectar->prepare($sql12);
        $sql12->bindValue(1,$saldo_act);
        $sql12->bindValue(2,$numero_venta);
        $sql12->bindValue(3,$id_paciente);
        //$sql12->bindValue(3,$sucursal);
        $sql12->execute();
    }

$sql = 'update detalle_orden_cobro set estado=?,comprobante=?,saldo=? where numero_recibo=? and numero_orden=? and id_paciente=?;';
   $sql=$conectar->prepare($sql);
   $sql->bindValue(1, $estado);
   $sql->bindValue(2, $comprobante_odc);
   $sql->bindValue(3, $saldo_act);
   $sql->bindValue(4, $numero_recibo);
   $sql->bindValue(5, $numero_orden);
   $sql->bindValue(6, $id_paciente);
   $sql->execute();



}else{

  $sql3="select * from creditos where numero_venta=? AND id_paciente=?;";             
  $sql3=$conectar->prepare($sql3);
  $sql3->bindValue(1,$numero_venta);
  $sql3->bindValue(2,$id_paciente);
  $sql3->execute();

  $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultados as $b=>$row){
      $re["saldo_actual"] = $row["saldo"];
      $re["tipo_credito"] = $row["tipo_credito"];
  }
    //la cantidad total es la suma de la cantidad más la cantidad actual
    $saldo_actual_doc = $row["saldo"];

   $sql = 'update detalle_orden_cobro set estado="DNG",saldo=? where numero_recibo=? and numero_orden=? and id_paciente=?;';
   $sql=$conectar->prepare($sql);
   $sql->bindValue(1, $saldo_actual_doc);
   $sql->bindValue(2, $numero_recibo);
   $sql->bindValue(3, $numero_orden);
   $sql->bindValue(4, $id_paciente);
   $sql->execute();
}

////////////INSERTAR EN TABLA ABONOS //////
$sql5 = 'insert into abonos values(null,?,?,?,?,?,?,?,?);';
$sql5 = $conectar->prepare($sql5);
$sql5->bindValue(1,$monto_abono);
$sql5->bindValue(2,$tipo_pago_oc);  
$sql5->bindValue(3,$hoy); 
$sql5->bindValue(4,$id_paciente); 
$sql5->bindValue(5,$id_usuario);
$sql5->bindValue(6,$numero_recibo);
$sql5->bindValue(7,$numero_venta); 
$sql5->bindValue(8,$sucursal_oc);
$sql5->execute();


/////////////////////////// INGRESAR EN CORTE EMPRESARIAL /////////////

}///////FIN FOR EACH RECORRE arraY

/////////////////   Actualizar estado orden cobro  /////////////
$sql4 = "update orden_cobro set estado='1',forma_cobro=? where numero_orden=?;";
$sql4 = $conectar->prepare($sql4);
$sql4->bindValue(1, $tipo_pago_oc);
$sql4->bindValue(2, $numero_orden);
$sql4->execute();
  
}



}
////SELECT u.usuario,v.fecha_venta,v.paciente,v.monto_total,v.tipo_venta,v.tipo_pago,v.sucursal from ventas as v inner join usuarios as u on v.id_usuario=u.id_usuario where v.fecha_venta like "%02-2021%" and v.sucursal="San Miguel" order by v.id_ventas desc limit 500;

 ?>