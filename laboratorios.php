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

                <a class="btn btn-app"  data-toggle="modal" data-target="#nueva_orden_lab" data-backdrop="static" data-keyboard="false">
                  <i class="fas fa-plus" style="color:#008080"></i> CREAR ORDEN
                </a>

                <a class="btn btn-app" onClick="listado_general_envios();">
                  <span class="badge bg-warning">3</span>
                  <i class="fas fa-history"></i> PENDIENTES
                </a>

                <a class="btn btn-app" onClick="listado_ordenes_enviadas();">
                  <span class="badge bg-info">3</span>
                  <i class="fas fa-share"></i> ENVIADOS
                </a>

                <a class="btn btn-app">
                  <span class="badge bg-success">3</span>
                  <i class="fas fa-file-import"></i> RECIBIDOS
                </a>

                <a class="btn btn-app">
                  <span class="badge bg-danger">3</span>
                  <i class="far fa-frown"></i> RETRASOS
                </a>

                <a class="btn btn-app">
                  <span class="badge bg-primary">3</span>
                  <i class="far fa-thumbs-up"></i> ENTREGADOS
                </a>

            </div>
    <section>
    <table id="data_envios_lab" width="100%" style="text-align: center;text-align:center" data-order='[[ 0, "desc" ]]' class="table-hover table-bordered display nowrap">
      <thead style="color:black;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-info">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 15px">
            <td style="text-align:center;width: 5%">ID</td>
            <td style="text-align:center;width: 10%"></td>
            <td style="text-align:center;width: 10%">Paciente</td>
            <td style="text-align:center;width: 25%">#Orden</td>
            <td style="text-align:center;width: 15%"><span id="fecha_ord">Creación</span></td>
            <td style="text-align:center;width: 15%"><span id="dias_orden">Dias transcurridos</span></td>
            <td style="text-align:center;width: 10%">Estado</td>
            <td style="text-align:center;width: 10%">Detalles</td>
            <!--<td style="text-align:center;width: 10%">Acciones</td>-->
         </tr>
        </thead>
        <tbody style="text-align:center;color: black;">                                        
        </tbody>
        <!--<tfoot>
          <tr>
            <td colspan="100">Hola</td>
          </tr>
        </tfoot>-->
      </table>
    </section>
       <button type="button" class="btn btn-outline-dark btn-block send_orden" onClick="send_orden_lab();" id="btn_enviar_lab"><i class="fas fa-share-square"></i> ENVIAR LABORATORIO</button>
     <button type="button" class="btn btn-outline-primary btn-block" id="btn_recibir_lab" onClick="recibir_orden_lab();"><i class="fas fa-share-square"></i> RECIBIR</button>
    </div>
    </div>
          <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
          <input type="hidden" name="usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
          <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
          <input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="ENVIOS A LABORATORIO">

  <!-- The Modal -->
  <div class="modal fade" id="modal_consultas_orden">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">      
        <!-- Modal body -->
        <div class="modal-body">
          <table id="data_consultas_orden" width="100%" style="text-align: center;text-align:center" class="table-hover table-bordered display nowrap">
          <thead style="color:white;min-height:10px;border-radius: 2px;font-style: normal;font-size: 15px" class="bg-dark">
          <tr style="min-height:10px;border-radius: 3px;font-style: normal;font-size: 12px">
            <td style="text-align:center;width: 5%">ID</td>
            <td style="text-align:center;width: 20%">Titular</td>
            <td style="text-align:center;width: 25%">Evaluado</td>
            <td style="text-align:center;width: 25%">Empresa</td>
            <td style="text-align:center;width: 15%">Fecha Consulta</td>
            <td style="text-align:center;width: 10%">Acciones</td>
         </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                                        
        </tbody>
        </table>
        </div>        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

 <script type="text/javascript" src="js/laboratorios.js"></script>
 <script type="text/javascript" src="js/consultas.js"></script>
 <script type="text/javascript" src="js/bootbox.min.js"></script>
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