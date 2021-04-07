
<?php
require_once("config/conexion.php");
$empresa = $_POST["empresa"];

if($empresa == ""){	
	//echo "Debe seleccionar empresa";
	//header("Location: empresarial.php");
    //die();?>

    <script>
    	alert("Debe Seleccionar la empresa");
    	window.close();

    </script>

<?php }

if(isset($_SESSION["usuario"])){
require_once('header_dos.php');
require_once('modals/empresa.php');
?>


<div class="content-wrapper" >

<div style="margin: 1px">
  <div class="callout callout-info">
      <h5 align="center"><span style="background:#DCDCDC;padding: 8px;border-radius: 5px"><i class="fas fa-tasks" style="color:green;"></i><b>  ORDEN DE COBRO:&nbsp;<span style="color: red" id="empresa_act_oid"><?php echo $empresa;?></span> -- <span id="correlativo_orden"></span></b></span></h5>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOrdenCobro" style="margin-top:3px" onClick="get_cobros_empresariales();"><i class="fas fa-street-view"></i>
    BUSCAR PACIENTES
  </button>
  <table  id="d_oid" width="100%" class="table-hover table-bordered" style="font-size:12px;margin-top: 5px">
    <thead style="background: #00001a;color:white">
      <tr>
        <th style="text-align:center;width: 20%;" colspan="20">Titular</th>
        <th style="text-align:center;width: 20%;" colspan="20">Empresa</th>
        <th style="text-align:center;width: 10%;" colspan="10">Monto</th>
        <th style="text-align:center;width: 5%;" colspan="5">Plazo</th>
        <th style="text-align:center;width: 10%;" colspan="10">Saldo Act.</th>
        <th style="text-align:center;width: 10%;" colspan="10">Abono Act.</th>
        <th style="text-align:center;width: 10%;" colspan="10">Nuevo Saldo</th>
        <th style="text-align:center;width: 10%;" colspan="10">Subt.</th>
        <th style="text-align:center;width: 5%;" colspan="5">Elim.</th>
      </tr>
    </thead>
    <tbody id="listar_data_oid" style="width: 100%"></tbody>        

    <tfoot style='background:#E0E0E0'>
      <tr id="totales_oid">
        <td style="text-align:center;text-align:center;width: 90%" colspan="90"><strong>Monto total del cobro</strong></td>
        <td style="text-align:center;text-align:center" colspan="10"><strong><span>$</span><span id="total_abonos"></span></strong></td>                      
      </tr>
    <tfoot>                 
    </table>
<button class="btn btn-primary btn-block enviar_venta" id="btn_de_compra" style="border-radius:2px" onClick='saveOrdenCobro();'><i class="fas fa-save"></i> REGISTRAR COBRO</button>        
  </div><!--FIN callout callout-info-->
<div id="modalOrdenCobro" class="modal fade" data-modal-index="2">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background:#0275d8;color: white;text-align: center">
              <span class="modal-title">CREDITOS EMPRESARIALES</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: white;color:black;">
              <div class="card-body p-0" style="margin:1px">
                <table id="lista_creditos_emp" width="100%" class="table-hover table-bordered">
                 <thead class="bg-secondary" style="text-align: center">
                   <tr>
                    <th>Seleccionar</th>          
                    <th>Paciente</th>
                    <th>Empresa</th>
                    <th>Monto</th>
                    <th>Saldo</th>
                   </tr>
                  </thead>
                  <tbody style="text-align:center">                                  
                  </tbody>
                </table>
              </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-block" onClick="get_data_credito_oid();">AGREGAR PACIENTES</button>
      </div>
          </div>
          <!-- /.modal-content -->
        </div>
</div>
<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"
/>
<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"
/>
</div><!--fin content wrapper-->
<?php require_once("footer.php"); ?>
<script src="js/empresas.js"></script>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/empresas.js"></script>
<script type="text/javascript" src="js/recibos.js"></script>
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
