<?php ob_start();

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){

date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");

 $direccion = "Boulevard de los Heroes. Centro Comercial Metrocentro Local#7 San Salvador";
  $telefono = "2260-1653";
  $wha = "7469-2542";
  $dir2="San Salvador";

require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
$pacientes_cobro = $reporteria->get_pacientes_orden_cobro($_GET['numero_orden']);

$tabla = "";
$monto_orden=0;
for($j=0; $j<count($pacientes_cobro);$j++){
	$abono_actual = $pacientes_cobro[$j]["monto_abono"];
	$monto_orden = $monto_orden+$abono_actual;
    $indice = $j+1;

    if ($j % 2 == 0) {
    	$color = "#E8E8E8";
    }else{
    	$color = "white";
    }
	$tabla .= "
	if	
	<tr>
		<td colspan='5' style='width:5%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>".$indice."</td>
		<td colspan='35' style='width:35%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>".$pacientes_cobro[$j]["nombres"]."</td>
		<td colspan='12' style='width:12%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>"."$ ".number_format($pacientes_cobro[$j]["monto_credito"],2,".",",")."</td>
		<td colspan='12' style='width:12%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>"."$ ".number_format($pacientes_cobro[$j]["monto_abono"],2,".",",")."</td>
		<td colspan='12' style='width:12%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>"."$ ".number_format($pacientes_cobro[$j]["saldo_ant"],2,".",",")."</td>
		<td colspan='12' style='width:12%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>"."$ ".number_format($pacientes_cobro[$j]["saldo"],2,".",",")."</td>
		<td colspan='12' style='width:12%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;background:".$color."'>".$pacientes_cobro[$j]["fecha"]."</td>	
	</tr>
	";
}

?>

<html>
<body>

  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
    body{
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
    }
      html{
        margin-top: 10px;
        margin-left: 30px;
        margin-right:20px; 
        margin-bottom: 0px;
    }
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
    }

    .table2 {
       border-collapse: collapse;
    }

    @page { margin: 180px 50px; } 
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; } 
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; } 
    #footer .page:after { content: counter(page, upper-roman); } 
   </style>

 <table style="width: 100%;margin-top:2px">
<tr>
<td width="10%"><img src="images/logooficial.jpg" width="130" height="75"/></td>

<td width="75%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:16px";font-family: Helvetica, Arial, sans-serif;><strong>OPTICA AVPLUS S.A de C.V.</strong></td>
  </tr>
  <tr>
    <td  style="text-align: center;margin-top: 0px;color:#0088b6;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><b>ORDEN DE COBRO</b></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:12px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong> <?php echo $wha;?>&nbsp;&nbsp;&nbsp;<br></span>E-mail: metrocentro@opticaavplussv.com</td>
  </tr>


</table><!--fin segunda tabla-->
</td>
<td width="30%">
<table>
  <tr>
    <td style="text-align:right; font-size:12px"><strong>ORDEN COBRO</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $_GET['numero_orden'];?></strong></td>
  </tr>
</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>  
<p><h3><b>EMPRESA: <span><?php echo $_GET["empresa"]?></span></b></h3></p>

<div style="width:100%;margin-top:0px;font-size:12px;font-family: Helvetica, Arial, sans-serif;height: 885px">
 <table width="100%" class="table2">

    <tr>
    	<td colspan='5' style='width:5%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>#</b></td>
        <td colspan='35' style='width:35%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>PACIENTE</b></td>
        <td colspan='12' style='width:12%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>MONTO</b></td>
        <td colspan='12' style='width:12%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>ABONO</b></td>
        <td colspan='12' style='width:12%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>SALDO ANT</b></td>
        <td colspan='12' style='width:12%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>NUEVO SALDO</b></td>
        <td colspan='12' style='width:12%;text-align:center;border: solid 1px white;background:#5bc0de;color: black;font-size:11px'><b>FECHA COBRO</b></td>
      </tr>
    <!--Aqui iran las variables PHP-->
     <?php echo $tabla;?>

  <tfoot style="margin-top: 0px">
  	<tr>
  		<td colspan="52" style='width:52%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;color: black;font-size:11px'><b>TOTAL ABONOS</b></td>
  		<td colspan="12" style='width:12%;font-size:12px;text-align:center;border: solid 1px #A0A0A0;color: red;font-size:11px'><b><?php echo "$ ".number_format($monto_orden,2,".",","); ?></b></td>
  		<td colspan="36" style='width:36%;font-size:11px;text-align:center;border: solid 1px #A0A0A0;color: black;font-size:11px'></td>

  	</tr>
 </tfoot> 
</table>
</div>
<span style="text-align: right;font-size: 9px;margin-top: 8PX" align="right">Este documento ha sido emitido por el departamento Empresarial de Óptica AV Plus. user: <?php echo $_SESSION["id_usuario"]."&nbsp;-&nbsp;".$hoy;?></span> 
 <p style="page-break-before: always;text-align: center;margin-top: 50px"></p> 
<?php
for($j=0; $j<count($pacientes_cobro);$j++){
	$numero_venta = $pacientes_cobro[$j]["numero_venta"];
	$numero_rec_oc = $pacientes_cobro[$j]["numero_recibo"];
	$id_paciente_oc = $pacientes_cobro[$j]["id_paciente"];

	include("imprimir_recibo_empresarial_pdf.php");
}
?>
 </body>
</html>

<?php
$salida_html = ob_get_contents();

//$user=$_SESSION["id_usuario"];
ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);
//(Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
//Render the HTML as PDF
$dompdf->render();
//Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));

?>
<?php  } else{

     header("Location: index.php");
  }?>