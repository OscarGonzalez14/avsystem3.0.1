<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/laboratorios/nueva_orden_lab.php');

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
      <div style="margin-left: 1px;display: flex; justify-content: center;">&nbsp;&nbsp;

      </div>
            <div class="card" style="margin: 1px">
              <div class="card-body">

                <a class="btn btn-app" data-toggle="modal" data-target="#nueva_orden_lab" data-backdrop="static" data-keyboard="false">
                  <i class="fas fa-plus" style="color:#008080" onClick="get_correlativo_requisiciones();"></i> CREAR ORDEN
                </a>'

                </div>

    <table id="data_requisicios" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
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
          <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
          <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="ENVIOS A LABORATORIO">
 <script type="text/javascript" src="js/caja.js"></script>
   <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+ title;
  </script>

    <!-- MODAL DEPOSITO A CAJA CHICA -->
  
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>