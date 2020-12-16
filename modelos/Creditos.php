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

}/////FIN CLASS

?>