<?php 
require_once("../config/conexion.php");

	class Creditos extends conectar{
	
	public function get_creditos_contado($sucursal){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado
from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
where c.tipo_credito='Contado' and p.sucursal=? order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

/////////////////////////LISTAR CREDITOS DE CARGO AUTOMATICO
    public function get_creditos_cauto($sucursal){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Cargo Automatico' and p.sucursal=? order by c.id_credito DESC;;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }
//////////////////////LISTAR CREDITOS DE DESCUENTO EN PLANILLA
    public function get_creditos_oid($sucursal,$empresa){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,p.empresas,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado
        from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta
        where c.forma_pago='Descuento en Planilla' and p.sucursal=? and p.empresas=? order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$sucursal);
    $sql->bindValue(2,$empresa);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    /////////////GET DATOS DE PACIENTE PARA MODAL GENERICA DE CREDITOS
    public function get_data_paciente_abonos($id_paciente,$id_credito,$numero_venta){
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select c.id_paciente,c.monto/c.plazo as cuotas,c.numero_venta,c.id_credito,c.monto,c.saldo,v.paciente,v.evaluado,p.telefono,p.empresas
        from creditos as c inner join ventas as v on c.numero_venta=v.numero_venta inner join pacientes as p on p.id_paciente=c.id_paciente where c.id_paciente=? and v.numero_venta=?
        and c.numero_venta=? and c.id_paciente=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_paciente);
        $sql->bindValue(2, $numero_venta);
        $sql->bindValue(3, $numero_venta);
        $sql->bindValue(4, $id_paciente);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

        public function get_abono_ant($id_paciente,$numero_venta){
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select monto_abono from abonos where numero_venta=? and id_paciente=? order by id_abono DESC limit 1";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $numero_venta);
        $sql->bindValue(2, $id_paciente);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    //////LISTAR DETALLE DE ABONOS
     public function get_detalle_abonos($id_paciente,$numero_venta){
    $conectar= parent::conexion();
    $sql= "SELECT a.fecha_abono,a.forma_pago,a.n_recibo,a.monto_abono,a.sucursal,u.usuario,c.monto,p.nombres,p.empresas from abonos as a inner join creditos as c on c.numero_venta=a.numero_venta inner join usuarios as u on a.id_usuario=u.id_usuario inner join pacientes as p on p.id_paciente=a.id_paciente where a.id_paciente=? and a.numero_venta=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->bindValue(2, $numero_venta);
    $sql->execute();
    return $resultado=$sql->fetchAll();
    }

    //////////////GET DATOS DE PACIENTE DE MODAL ABONOS
    public function get_datos_abonos($id_paciente,$numero_venta){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select c.monto,sum(a.monto_abono) as abonado,p.nombres,c.monto-(sum(a.monto_abono)) as saldo
        from creditos as c inner join abonos as a on c.numero_venta=a.numero_venta inner join
        pacientes as p on c.id_paciente=p.id_paciente where a.id_paciente=? and a.numero_venta=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->bindValue(2, $numero_venta);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get_creditos_automaticos(){
    $conectar= parent::conexion();
    $sql= "select c.numero_venta,p.nombres,c.monto,c.saldo,p.id_paciente,c.id_credito,v.evaluado from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente inner join ventas as v on c.numero_venta=v.numero_venta where c.forma_pago='Cargo Automatico' and p.sucursal='Metrocentro' order by c.id_credito DESC;";
    $sql=$conectar->prepare($sql);
   // $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////GET PACIENTES CATEGORIA C
    public function get_creditos_cat_b(){
    $conectar= parent::conexion();
    $sql= "select p.nombres, p.empresas,r.numero_venta,r.id_paciente,max(r.prox_abono) as prox_abono,r.abono_act, datediff(now(),max(r.prox_abono)) as dif_days,r.monto,max(r.fecha) as fecha_abono,r.saldo,c.saldo,sum(r.abono_act) as abonado,c.forma_pago  from
pacientes as p inner join recibos as r on r.id_paciente=p.id_paciente join creditos as c where c.numero_venta COLLATE utf8mb4_general_ci =r.numero_venta and c.saldo>0 group by r.numero_venta having dif_days>30 and dif_days<90 and max(r.fecha) order by r.id_recibo DESC;
";
    $sql=$conectar->prepare($sql);
   // $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////GET PACIENTES CATEGORIA C
    public function get_creditos_cat_c(){
    $conectar= parent::conexion();
    $sql= "select p.nombres, p.empresas,r.numero_venta,r.id_paciente,max(r.prox_abono) as prox_abono,r.abono_act, datediff(now(),max(r.prox_abono)) as dif_days,r.monto,max(r.fecha) as fecha_abono,r.saldo,c.saldo,sum(r.abono_act) as abonado,c.forma_pago from pacientes as p inner join recibos as r on r.id_paciente=p.id_paciente join creditos as c where c.numero_venta COLLATE utf8mb4_general_ci =r.numero_venta group by r.numero_venta and c.saldo>0 having dif_days>90 order by r.id_recibo DESC;
";
    $sql=$conectar->prepare($sql);
   // $sql->bindValue(1,$sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //////////////GET DATOS DE PACIENTE CREDITOS EN MORA
    public function get_datos_creditos_mora($id_paciente){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select*from pacientes where id_paciente=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    }

/////////////////////GET CORRELATIVO FACTURAS
public function get_correlativo_factura($sucursal){
  $conectar= parent::conexion();
  $sql= "select n_correlativo+1 as n_correlativo from correlativo_factura where sucursal=? order by id_correlativo desc limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$sucursal);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

///////// VALIDAR CORRELATIVO 
public function validar_correlativo($correlativo_fac,$sucursal){
    $conectar  = parent::conexion();
    parent::set_names();
    $sql = "select n_correlativo from correlativo_factura where n_correlativo=? and sucursal=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$sucursal);
    $sql->execute();
    return $resultado = $sql->fetchAll();
}

public function registrar_impresion_factura($sucursal,$numero_venta,$id_usuario,$correlativo_fac,$id_paciente){
    $conectar = parent::conexion();
    parent::set_names();
    $sql ="insert into correlativo_factura values(null,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$sucursal);
    $sql->bindValue(3,$numero_venta);
    $sql->bindValue(4,$id_usuario);
    $sql->execute();

    ////////////////////UPDATE EN CORTE DIARIO //////////
    $sql = "update corte_diario set n_factura = ? where n_venta =? and id_paciente=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$correlativo_fac);
    $sql->bindValue(2,$numero_venta);
    $sql->bindValue(3,$id_paciente);
    $sql->execute();

}

/************************************************************
*****************ORDENES DE DESCUENTO EN PLANILLA************
*************************************************************/
public function get_ordenes_descuento_pendientes($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente where o.sucursal=? and estado='0' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

//////////////////GET DATA ORDEN CREDITO
public function get_data_orden_credito($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from orden_credito where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_paciente_id($id_paciente){
    $conectar= parent::conexion();
    parent::set_names();
    $sql="select *from pacientes where id_paciente=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_orden_credito($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from detalle_ventas_flotantes where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_detalle_venta_flotante($id_paciente,$n_orden){
    $conectar= parent::conexion();
    parent::set_names(); 
    $sql="select*from ventas_flotantes where id_paciente=? and numero_orden=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->bindValue(2,$n_orden);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
///////////APROBAR ORDEN
public function aprobar_orden(){

 $conectar = parent::conexion();
///////detalle productos venta flotante
 $detalle_orden = array();
 $detalle_orden = json_decode($_POST["detOrden"]);
 //////////////////detalle venta flotante
 $detalle_venta = array();
 $detalle_venta = json_decode($_POST["arrayVenta"]);
 $plazo = $_POST["plazo"];
 $numero_orden = $_POST["numero_orden"];
 date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y");

foreach ($detalle_venta as $k => $v) {
    $evaluado = $v->evaluado;
    $fecha_venta = $v->fecha_venta;
    $id_paciente = $v->id_paciente;
    $id_usuario = $v->id_usuario;
    $monto_total = $v->monto_total;
    $optometra = $v->optometra;
    $paciente = $v->paciente;
    $sucursal = $v->sucursal;
    $tipo_pago = $v->tipo_pago;
    $tipo_venta = $v->tipo_venta;
    $vendedor = $v->vendedor;
}


require_once("Ventas.php");

$ventas = new Ventas();
$correlativo = $ventas->get_numero_venta($sucursal);
  
  $prefijo = "";
  if ($sucursal=="Metrocentro") {
    $prefijo="ME";
  }elseif ($sucursal=="Santa Ana") {
    $prefijo="SA";
  }elseif ($sucursal=="San Miguel") {
    $prefijo="SM";
  }
    if(is_array($correlativo)==true and count($correlativo)>0){
    foreach($correlativo as $row){                  
      $codigo=$row["numero_venta"];
      $cod=(substr($codigo,5,11))+1;
      $num_venta ="AV".$prefijo."-".$cod;
    }             
  }else{
      $num_venta = "AV".$prefijo."-1";
  }

////////////////RECORRER ARRAR PARA EXTAER VALORES E INSERTAR DETALLE DE VENTA
 foreach ($detalle_orden as $item => $valor) {
    $beneficiario = $valor->beneficiario;
    $cantidad = $valor->cantidad;
    $categoria_ub = $valor->categoria_ub;
    $descuento = $valor->descuento;
    $fecha_venta = $valor->fecha_venta;
    $id_paciente = $valor->id_paciente;
    $id_producto = $valor->id_producto;
    $id_usuario = $valor->id_usuario;
    $precio_final = $valor->precio_final;
    $precio_venta = $valor->precio_venta;
    $producto = $valor->producto;

      //////////OBETENER LA DESCRIPCION DEL PRODUCTO /////////////
    $sqlp = "select*from productos where id_producto=?;";
    $sqlp = $conectar->prepare($sqlp);
    $sqlp->bindValue(1,$id_producto);
    $sqlp->execute();

    $detalles_producto = $sqlp->fetchAll(PDO::FETCH_ASSOC);

    foreach ($detalles_producto as $item){
    $cat_prod = $item["categoria_producto"];
    if ($cat_prod == "aros") {
        $descripcion = "ARO.: ".$item["marca"]." MOD.:".$item["modelo"]." COLOR.:".$item["color"]." MED.:".$item["medidas"]." ".$item["diseno"];
    }elseif($cat_prod=="Lentes"){
          $descripcion = "LENTE: ".$item["desc_producto"];
    }elseif($cat_prod=="Antireflejante" or $cat_prod=="Photosensible"){
          $descripcion = "TRATAMIENTOS: ".$item["desc_producto"];
    }elseif($cat_prod=="accesorios"){
          $descripcion = "ACC: ".$item["desc_producto"];
    }
    }

    $sql="insert into detalle_ventas values(null,?,?,?,?,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$num_venta);
    $sql->bindValue(2,$id_producto);
    $sql->bindValue(3,$descripcion);
    $sql->bindValue(4,$precio_venta);
    $sql->bindValue(5,$cantidad);
    $sql->bindValue(6,$descuento);
    $sql->bindValue(7,substr($precio_final,1,8));
    $sql->bindValue(8,$hoy);
    $sql->bindValue(9,$id_usuario);
    $sql->bindValue(10,$id_paciente);
    $sql->bindValue(11,$beneficiario);
    // $sql->bindValue(12,$precio_compra);
    $sql->execute();

    if($cat_prod=="aros" or $cat_prod == "accesorios"){
    ////////////////////ACTUALIZAR STOCK DE BODEGA SI PRODUCTO == aros o accesorios
      $sql3="select * from existencias where id_producto=? and bodega=? and categoria_ub=?;";           
      $sql3=$conectar->prepare($sql3);
      $sql3->bindValue(1,$id_producto);
      $sql3->bindValue(2,$sucursal);
      $sql3->bindValue(3,$categoria_ub);
      $sql3->execute();

      $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);

      foreach($resultados as $b=>$row){
      $re["existencia"] = $row["stock"];
    }            
    
    $cantidad_totales = $row["stock"] - $cantidad;

    if(is_array($resultados)==true and count($resultados)>0) {                    

      $sql12 = "update existencias set stock=? where id_producto=? and bodega=? and categoria_ub=?;";
      $sql12 = $conectar->prepare($sql12);
      $sql12->bindValue(1,$cantidad_totales);
      $sql12->bindValue(2,$id_producto);
      $sql12->bindValue(3,$sucursal);
      $sql12->bindValue(4,$categoria_ub);

      $sql12->execute();
  } 
 }
}

//////////////GET NUMERO VENTA

 ///////////////REGISTRAR VENTA
 $sql2="insert into ventas values(null,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql2=$conectar->prepare($sql2);
          
    $sql2->bindValue(1,$hoy);
    $sql2->bindValue(2,$num_venta);
    $sql2->bindValue(3,$paciente);
    $sql2->bindValue(4,$vendedor);       
    $sql2->bindValue(5,$monto_total);
    $sql2->bindValue(6,$tipo_pago);
    $sql2->bindValue(7,$tipo_venta);          
    $sql2->bindValue(8,$id_usuario);
    $sql2->bindValue(9,$id_paciente);
    $sql2->bindValue(10,$sucursal);
    $sql2->bindValue(11,$evaluado);
    $sql2->bindValue(12,$optometra);
    $sql2->execute();

    ///////////////////////INSERTAR CREDITOS
    $sql1="insert into creditos values(null,?,?,?,?,?,?,?,?,?);";
    $sql1=$conectar->prepare($sql1);          
    $sql1->bindValue(1,$tipo_venta);
    $sql1->bindValue(2,$monto_total);
    $sql1->bindValue(3,$plazo);
    $sql1->bindValue(4,$monto_total);
    $sql1->bindValue(5,$tipo_pago);
    $sql1->bindValue(6,$num_venta);
    $sql1->bindValue(7,$id_paciente);
    $sql1->bindValue(8,$id_usuario);
    $sql1->bindValue(9,$hoy);
    $sql1->execute();

    $n_recibo="";
    $n_factura="";
    $forma_cobro="";
    $monto_cobrado="";
    $abono_anterior="0";
    $abonos_realizados="0";
    $sucursal_cobro="";
    $tipo_ingreso = "Venta";

    $sql2="insert into corte_diario values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $sql2=$conectar->prepare($sql2);          
    $sql2->bindValue(1,$hoy);
    $sql2->bindValue(2,$n_recibo);
    $sql2->bindValue(3,$num_venta);
    $sql2->bindValue(4,$n_factura);
    $sql2->bindValue(5,$paciente);
    $sql2->bindValue(6,$vendedor);
    $sql2->bindValue(7,$monto_total);
    $sql2->bindValue(8,$forma_cobro);
    $sql2->bindValue(9,$monto_cobrado);
    $sql2->bindValue(10,$monto_total);
    $sql2->bindValue(11,$tipo_venta);
    $sql2->bindValue(12,$tipo_pago);
    $sql2->bindValue(13,$id_usuario);
    $sql2->bindValue(14,$abono_anterior);
    $sql2->bindValue(15,$abonos_realizados);
    $sql2->bindValue(16,$id_paciente);
    $sql2->bindValue(17,$sucursal);
    $sql2->bindValue(18,$sucursal_cobro);
    $sql2->bindValue(19,$tipo_ingreso);
    $sql2->execute();

    //////ACRUALIZAR ESTADO DE ORDEN

    $sql3 = "update orden_credito set estado='1' where numero_orden=? and id_paciente=?;";
    $sql3 = $conectar->prepare($sql3);
    $sql3->bindValue(1,$numero_orden);
    $sql3->bindValue(2,$id_paciente);
    $sql3->execute();
}

public function denegar_orden($numero_orden){
    $conectar = parent::conexion();
    $sql3 = "update orden_credito set estado='2' where numero_orden=?;";
    $sql3 = $conectar->prepare($sql3);
    $sql3->bindValue(1,$numero_orden);
   
    $sql3->execute();
    
}

public function buscar_existe_oid($id_paciente){
    $conectar = parent::conexion();
    parent::set_names(); 
    $sql="select numero_orden from orden_credito where id_paciente=? order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_saldos_oid($id_paciente){
    $conectar = parent::conexion();
    $sql= "select  p.nombres,p.empresas,c.saldo as saldos from creditos as c inner join pacientes as p on c.id_paciente=p.id_paciente  where c.id_paciente=? and c.forma_pago='Descuento en Planilla' order by c.id_credito limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_paciente);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function agregar_benefiaciario_oid(){
    
}




/************************************************************
*******ORDENES DE DESCUENTO EN PLANILLA APROBADAS************
*************************************************************/
public function get_ordenes_descuento_aprobadas($sucursal){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="select o.numero_orden,p.nombres,p.empresas,p.id_paciente,o.fecha_registro,o.estado,o.id_orden,o.sucursal from orden_credito as o inner join pacientes as p on o.id_paciente = p.id_paciente where o.sucursal=? and estado='1' order by o.id_orden DESC;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $sucursal);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}

  //////////////FUNCION PARA ELIMINAR PACIENTE
  public function eliminar_oid($id_orden, $numero_orden, $id_paciente){
    $conectar=parent::conexion();
    $sql="delete from orden_credito where id_orden=? and numero_orden=? and id_paciente=?; ";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $id_orden);
    $sql->bindValue(2, $numero_orden);
    $sql->bindValue(3, $id_paciente);
    $sql->execute();
    return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  }

}/////FIN CLASS
?>