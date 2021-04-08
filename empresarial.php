<?php
require_once("config/conexion.php");

if(isset($_SESSION["usuario"])){

require_once('header_dos.php');
require_once('modals/empresa.php');
?>


<div class="content-wrapper" >
  <!-- Button to Open the Modal -->
  <div style="margin: 5px;">
  <button type="button" class="btn btn-dark"style="float: right;margin-top: 3px;color: white">
    CORTE EMPRESARIAL
  </button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#empresasModal" onClick="listar_en_pacientes();" style="margin-top:3px"><i class="far fa-clipboard"></i>
    SELECCIONAR EMPRESA
  </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newEmpresa" style="margin-top:3px"><i class="fas fa-sort-amount-down"></i>
    BUSCAR PACIENTES
  </button>
     <form action="orden_cobro.php" method="POST" target="_blank">
     	<input type="hidden" id="empresa" name="empresa">
    <button type="submit" class="btn btn-success"style="float: right;margin-top: 3px;background:#0d645c;color: white" onClick="nueva_orden_pago()"><i class="nav-icon fas fa-cash-register"></i>
    ORDEN DE COBRO
  </button>


</form>
  </div>


<div style="margin: 1px">
  <div class="callout callout-info">
        <h5 align="center"><i class="fas fa-tasks" style="color:green"></i><b>  PACIENTES:&nbsp;<span id="empresa_act" style="color: red"></span></b></h5>              
    </div>
    
  <table class="table-hover table-bordered" id="data_empresas_cread" width="100%">
        <thead style="background:#034f84;color:white;max-height:10px">
          <tr>
            <th style="text-align:center;width: 6%">ID</th>
            <th style="text-align:center;width: 40%">Paciente</th>
            <th style="text-align:center;width: 13%">Monto</th>
            <th style="text-align:center;width: 13%">Saldo</th>
            <th style="text-align:center;width: 15%">Ultimo abono</th>
            <th style="text-align:center;width: 13%">Dias transcurridos</th>
          </tr>
        </thead>
    <tbody style="text-align:center">                                        
    </tbody>
  </table><!-- /.content -->
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


</div><!--fin content wrapper-->
<?php require_once("footer.php"); ?>
<script src="js/empresas.js"></script>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>
<script>
  var nit = new Cleave('#nitEmpresa', {
    delimiter: '-',
    blocks: [4,6,3,1],
    uppercase: true
});
var telefono = new Cleave('#telEmpresa', {
    delimiter: '-',
    blocks: [4,4],
    uppercase: true
});


</script>
<?php } else{
echo "Acceso denegado";
header("Location:index.php");
        exit();
  } ?>
