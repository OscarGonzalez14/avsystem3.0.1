<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header_dos.php');
require_once('modals/modal_detalle_ventas.php');
date_default_timezone_set('America/El_Salvador'); $hoy = date("D-m-y");;
?>

<div class="content-wrapper">
    <div class="row" style="margin:11px;">
          <section>
            <div class="form-row">

              <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-5">
                <label for="mes_venta">SELECCIONE MES:</label>
                <input type="month" class="form-control float-right mes_venta" id="mes_venta" onClick="rango_fecha();">
              </div>

              <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-2">
                <label for="fecha_final">Mostrar</label>
                <div class="input-group-prepend" onClick="ver_ventas();">
                  <span class="input-group-text" id="basic-addon01" style="background:#001a57;color: white">&nbsp;&nbsp;<i class="fas fa-search">&nbsp;&nbsp;</i></span>
                </div>
              </div>
            </div><!--Fin row 1-->
          </section>
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
          <th>Paciente Evaluado</th>
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

 
