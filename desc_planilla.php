<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/nueva_requisicion.php');

$cat_user = $_SESSION["categoria"];
require_once("modelos/Reporteria.php");
$alerts = new Reporteria();
?>

 <style type="text/css">
    .dataTables_filter {
   float: right !important;
   width: 100%;
}
</style>

 <div class="content-wrapper">
<input type="hidden" name="cat_user" id="cat_user" value="<?php echo $cat_user;?>"/>
    <section class="content" style="border-right:50px">
      <div class="container-fluid">
    <div class="col-md-12">

          <div class="card" style="margin: 1px">
              <div class="card-body">
                <h4 align="center">DESCUENTOS EN PLANILLA</h4>

                <?php if($cat_user=="administrador"){
                  echo '
                <a class="btn btn-app" onClick="listar_requicisiones_pendientes();">
                  <span class="badge bg-danger"><i class=" fas fa-bell"></i>';?> <?php echo $alerts->count_req_pendientes()?> <?php echo '</span>
                  <i class="fas fa-clipboard-check" style="color:#00407e"></i> ORDENES DE DESCUENTO PENDIENTES
                </a>';
              }
                ?>

              </div>
    <!--ESTE DATATABLE SE RECARGA DESDE  credit-->
    <table id="ordenes_desc_pendientes" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 11px">

            <td  style="text-align:center;"># Orden</td>
            <td  style="text-align:center;">Paciente</td>
            <td  style="text-align:center;">Empresa</td>
            <td  style="text-align:center;">Fecha creación</td>
            <td  style="text-align:center;">Estado</td>
            <td style="text-align:center;">Detalles</td>
            <td style="text-align:center;">Editar</td>
            <td style="text-align:center;">Eliminar</td>
         </tr>
        </thead>
        <tbody style="text-align:center;color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">                                        
        </tbody>
      </table>
    </div>
    </div>
          <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
          <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
          <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
          <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="MODULO CAJA CHICA">
 <script type="text/javascript" src="js/creditos.js"></script>
   <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
  </script>

    <!-- MODAL DEPOSITO A CAJA CHICA -->
  <div class="modal fade" id="depositos_caja">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">CAJA CHICA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row">

            <div class="col-sm-12 invoice-col">
              <span style="margin-right: 5px"><strong>Saldo Actual $<span id="saldo_caja" style="font-size: 18px;color: blue"></span></strong><br>
              <label>Monto a Depositar $</label>
                <input type="number" class="form-control" id="monto_deposito" style="margin:0px;text-align: right;">
              </div>
          </div>
        </div>
        <input type="hidden" id="tipo_mov" value="deposito">
        <input type="hidden" id="id_caja_chica">
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clear_items_req();"> CANCELAR</button>
              <button type="button" class="btn btn-success" onClick="deposito_caja();"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i> DEPOSITAR</button>
            </div>
        
      </div>
    </div>
  </div>
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>