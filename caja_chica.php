<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/nueva_requisicion.php');
require_once('modals/accion_requisicion_admin.php');
require_once('modals/modals_requisicion/modal_estado_uno.php');
require_once('modals/modals_requisicion/modal_estado_dos.php');
$cat_user = $_SESSION["categoria"];

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
    <div class="col-md-12" style="margin: 1px">
            <!-- Application buttons -->
            <div class="card" style="margin: 1px">
              <div class="card-header" style="display:flex;align-items: center">
                <h3 class="card-title" style="text-align: center">MÓDULO DE CAJA CHICA</h3>
              </div>
              <div class="card-body">
                <a class="btn btn-app" data-toggle="modal" data-target="#nueva_requisicion" data-backdrop="static" data-keyboard="false">
                  <i class="fas fa-plus" style="color:#008080" onClick="get_correlativo_requisiciones();"></i> CREAR REQUISICIÓN
                </a>
                <?php if($cat_user=="administrador"){
                  echo '
                <a class="btn btn-app" onClick="listar_requicisiones_pendientes();">
                  <span class="badge bg-danger">1</span>
                  <i class="fas fa-clipboard-check" style="color:#00407e"></i> REQ. PENDIENTES
                </a>';
              }
                ?>
              </div>

<table id="data_requisiciones" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">

            <td style="text-align:center">ID Req.</td>
            <td style="text-align:center">Correlativo Req.</td>
            <td style="text-align:center">Fecha</td>
            <td style="text-align:center">Estado</td>
            <td style="text-align:center">Sucursal</td>
            <td style="text-align:center">Acciones</td>
            <td style="text-align:center">Imprimir</td>
         </tr>
        </thead>
        <tbody style="text-align:center;color: black">                                        
        </tbody>
      </table>

            </div>


          </div>
          <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
          <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>

 
 <?php require_once("footer.php"); ?>
 <script type="text/javascript" src="js/caja.js"></script>
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>