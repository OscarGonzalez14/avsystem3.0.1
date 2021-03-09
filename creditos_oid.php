<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once("header_dos.php");
require_once("modals/modal_abonos.php");
require_once("modals/modal_detalle_abonos.php");
require_once("modals/modal_correlativo_factura.php");
 ?>

 <div class="content-wrapper">
  <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-5" style="align-items:left">
            <h5><strong><i class="fas fa-money-check" style="color:green"></i> DESCUENTO EN PLANILLA</strong></h5>
          </div>
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="creditos.php" style="color:black">Créditos</a></li>
              <li class="breadcrumb-item "><a href="creditos_contado.php">Contado</a></li>
              <li class="breadcrumb-item active"><a>Desc. Planilla</a></li>
              <li class="breadcrumb-item"><a href="creditos_cautomaticos.php">Cargo Auto</a></li>
              <li class="breadcrumb-item"><a href="creditos_mora.php">Créditos en mora</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <section class="content" style="margin-top:5px">
 	<div class="row">
 	 <div class="col-12">
 	  <div class="card">
 		<div class="card-body">
 		  <section class="content">
 			<div class="container_fluid"><!--inicio del contenido-->

           <div class="form-group row">
                  <div class="col-sm-4">
                  <label> Selecionar Empresa<span style="visibility: hidden;color: red" id="label_empresa">*</span></label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="empresa" readonly="">
                    <div class="input-group-append">
                      <span class="input-group-text bg-success" data-toggle="modal" data-target="#empresasModal" onClick="listar_en_pacientes();" style="color: white"><i class="fas fa-search"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-sm-2">
                  <label>Listar Pacientes</label>
                    <div class="input-group">
                      <button class="btn btn-primary btn-block" id="select_paciente_venta" onClick="listar_creditos_oid();"><i class="fas fa-file-alt"></i></button>
                  </div>
                </div>

                <div class="col-sm-2">
                  <label> OID Aprobadas</label>
                    <div class="input-group">
                      <a href="oid_aprobadas.php" class="btn btn-info form-control" style="background:#001a33;margin:solid #000066 1px" data-backdrop="static" data-keyboard="false"><i class="fas fa-file-import"></i>&nbsp;&nbsp;&nbsp;OIDS </a>
                  </div>
                </div>
                
              </div>
        <table id="creditos_oid" class="table-hover" width="100%">
           <thead style="background:#034f84;color:white;text-align: center;">
            <tr>
            <th style='text-align: center;'>No. Venta</th>
            <th style='text-align: center;'>Titular de cuenta</th>
            <th style='text-align: center;'>Empresa</th>
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
 			</div>
 		  </section>
 		</div>
 	  </div>
 	 </div>
 	</div>
 </section>
 </div>

<div id="empresasModal" class="modal fade" data-modal-index="2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <span class="modal-title">SELECCIONAR EMPRESA</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: white;color:black">
                    <div class="card-body p-0" style="margin:1px">
                <table id="lista_pacientes_data_emp" width="100%">
                  <thead class="bg-secondary">
                    <tr>
                    <th>Codigo</th>          
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center">                                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
</div>
<!--FIN MODAL PACIENTES-->
<?php require_once("footer.php");?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
<input type="hidden" id="name_pag" value="COBROS DESCUENTO EN PLANILLA">
<input type="hidden" id="id_consulta">
<input type="hidden" id="id_paciente">
<input type="hidden" id="optometra" value="">
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="js/pacientes.js"></script>
<script type="text/javascript" src="js/creditos.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/recibos.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>

  <script type="text/javascript">
    var title = document.getElementById("name_pag").value;
    document.getElementById("title_mod").innerHTML=" "+
    title;

     function mayus(e) {
    e.value = e.value.toUpperCase();
	}
  </script>
<script>
    $(function(){
      $('.btn[data-toggle=modal]').on('click', function(){
        var $btn = $(this);
        var currentDialog = $btn.closest('.modal-dialog'),
        targetDialog = $($btn.attr('data-target'));;
        if (!currentDialog.length)
          return;
        targetDialog.data('previous-dialog', currentDialog);
        currentDialog.addClass('aside');
        var stackedDialogCount = $('.modal.in .modal-dialog.aside').length;
        if (stackedDialogCount <= 5){
          currentDialog.addClass('aside-' + stackedDialogCount);
        }
      });

      $('.modal').on('hide.bs.modal', function(){
        var $dialog = $(this);  
        var previousDialog = $dialog.data('previous-dialog');
        if (previousDialog){
          previousDialog.removeClass('aside');
          $dialog.data('previous-dialog', undefined);
        }
      });
    })
  </script>

   <?php } else{
echo "Acceso denegado";
  } ?>
