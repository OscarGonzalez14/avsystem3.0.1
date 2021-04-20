<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/modal_detalle_ventas.php');
date_default_timezone_set('America/El_Salvador'); $hoy = date("D-m-y");;
?>

<div class="content-wrapper">
            <div class="row" style="margin-top: 5px">
              <div class="col-12">
                <div class="callout callout-info" style="border-bottom: solid 1px #008080;">

                  <div class="row">

                    <div class="col-sm-2">
                      <form action="corte_diario_pdf.php" method="POST" target="_blank">
                        <input type="date" id="ventas_mensuales" name="ventas_mensuales" class="form-control" value="<?php echo $hoy?>">
                        <input type="hidden" name="sucursal_user" id="sucursal_user" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
                        <input type="hidden" name="usuario" value="<?php echo $_SESSION["usuario"];?>">
                    </div>

                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i>CORTE DIARIO</button>
                    </div>

                </form>
                </div>
                </div>
              </div>
            </div>

  <div class="content" id="listar_reporte_ventas_mensuales">

    <div class="header" style="padding:7px;">
      <div class="row mb-2">
          <div class="col-sm-9">
            <h2 class="card-title" align="right" style="text-align:right;"><i class="far fa-file-alt" style="color:green"></i><strong>REPORTE MENSUAL VENTAS </strong></h2>
          </div>
          <div class="col-sm-3">
            <div>
             <ul class="breadcrumb float-sm-right" style="background-color:transparent;padding:0px;">
               <li class="breadcrumb-item"><a href="ventas.php">Nueva Venta</a></li>
               <li class="breadcrumb-item"><a href="reporte_gral_ventas.php"></a>Reporte</li>
               <li class="breadcrumb-item"><a href="recibos.php">Recibos</a></li>
             </ul>
           </div>
          </div>
      </div>

    </div><br>

    <div class="card-body p-0" style="margin:7px">
      <table id="lista_vtas_mensuales_data" width="100%" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered">
        <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
          <tr>
          <th>#Venta</th>
          <th>Fecha</th>
          <th>Asesor</th>
          <th>Paciente</th>
          <th>Evaluado</th>
          <th>Tipo Venta</th>
          <th>Tipo Pago</th>
          <th>Monto</th>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                                  
        </tbody>
      </table>
    </div>
 
  </div>
</div>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>

<?php require_once("footer.php");?>
<script src="js/ventas.js"> </script>

<?php } else{
    echo "Acceso no permitido";
  } ?>

 
