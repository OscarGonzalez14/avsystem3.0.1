<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header.php');
require_once('modals/modal_orden_cobro.php');
date_default_timezone_set('America/El_Salvador'); $hoy = date("Y-m-d");;
?>

<div class="content-wrapper">
            <div class="row" style="margin-top: 5px">
              <div class="col-12">
                <div class="callout callout-info" style="border-bottom: solid 1px #008080;">
                <h2 class="card-title" align="center" style="text-align:center;"><i class="far fa-file-alt" style="color:green"></i><strong> GESTION DE ORDENES DE COBRO</strong></h2><br>
                <div class="card-body p-0" style="margin:7px">
                  <table id="data_ordenes_cobro" width="100%" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered">
                    <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
                    <tr>
                      <th>ID</th>
                      <th>#Orden</th>
                      <th>Creada por</th>
                      <th>Fecha</th>
                      <th>Empresa</th>
                      <th>Monto</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                       
                    </tbody>
                  </table>
                </div>

                </div>
                </div>
              </div>
            </div> 
  </div>
</div>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>

<script src="js/recibos.js"> </script>
<script type="text/javascript">
  function get_date_corte() {
    let fecha_corte = document.getElementById("date_corte").value;
    console.log(fecha_corte);
    document.getElementById("fecha_corte").value = fecha_corte;
  }
 //get_date_corte();
</script>
<?php } else{
    echo "Acceso no permitido";
  } ?>

 
