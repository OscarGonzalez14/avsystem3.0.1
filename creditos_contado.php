
 <?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once("header_dos.php");
require_once("modals/modal_abonos.php");
require_once("modals/modal_detalle_abonos.php");

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content" style="margin-top: 5px">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <!-- /.card-header -->
<div class="card-body"><!--CONTENIDO-->

<section class="content">
  <div class="container-fluid"><!--INICIO DE CONTENIDO-->
<table id="creditos_de_contado" class="table-hover" width="100%" data-order='[[ 0, "desc" ]]'>
     <thead style="background:#034f84;color:white;text-align: center;">
       <tr>

        <th style='text-align: center;'>No. Venta</th>
        <th style='text-align: center;'>Titular de cuenta</th>
        <th style='text-align: center;'>Paciente Evaluado</th>        
        <th style='text-align: center;'>Monto</th>
        <th style='text-align: center;'>Saldo</th>
        <th style='text-align: center;'>Abonar</th>
        <th style='text-align: center;'>Historial</th>
        <th style='text-align: center;'>Factura</th>
       </tr>
     </thead>
     <tbody style="text-align: center">
   </table> 
  </div><!--FIN INICIO DE CONTENIDO-->
  </div>
</section>


<!-- IMPRIMIR FACTURA-->
<div class="modal fade" id="print_invoices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body" style="color: #ff6500;display: block;margin-left: auto;margin-right: auto;">
        <div>
          <i class="fas fa-exclamation-triangle fa-2x" style="color: #ff6500;text-align: center;"></i> <span style="font-size: 30px;color: #404040;font-family: font-family: Helvetica, Arial, sans-serif;"><b>Correlativo</span> <span style="font-size: 30px;color: red;font-family: font-family: Helvetica, Arial, sans-serif;"><span style="color: red" id="correlativo_factura"></span></span></b>
        </div>
      </div>
      <input type="hidden" name="" id="n_venta_factura">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="link_invoice_print" target="_blank" href=""><button type="button" class="btn btn-primary" onClick="registrar_impresion();">Imprimir</button></a>
      </div>
    </div>
  </div>
</div>

<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="COBROS DE CONTADO">
<input type="hidden" id="id_consulta">
<input type="hidden" id="id_paciente">
<input type="hidden" id="optometra" value="">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/creditos.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/recibos.js"></script>

  <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+
    title;
  </script>
</div><!-- FIN CONTENIDO-->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>

function mayus(e) {
    e.value = e.value.toUpperCase();
}


   <?php } else{
echo "Acceso denegado";
  } ?>
