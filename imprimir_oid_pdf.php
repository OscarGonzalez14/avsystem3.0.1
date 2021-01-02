<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';

require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
  $id_paciente =$_GET["id_paciente"];
  $n_venta =$_GET["n_venta"];
  $n_orden =$_GET["n_orden"];
  $sucursal = $_GET["sucursal"];
//echo $id_paciente.$n_venta.$n_orden;
if ($sucursal == "Metrocentro") {
  $direccion = "Boulevard de los Heroes. Centro Comercial Metrocentro Local#7 San Salvador";
  $telefono = "2260-1653";
  $wha = "7469-2542";
  $dir2="San Salvador";

}elseif ($sucursal == "San Miguel") {
  $direccion = "3<sup>ra</sup> Calle Poniente Av. Roosevelt Sur Esquina #115 ";
  $telefono = "2661 7549";
  $wha = "7946-0464";
  $dir2="San Miguel";
}elseif ($sucursal == "Santa Ana"){
    $direccion = " 61 Calle Pte. Block K9 #10, Col, Avenida El Trebol, Santa Ana";
    $telefono = "2445 3150";
    $wha = "-";
    $dir2="Santa Ana";
}
//$datos_recibo = $reporteria->print_recibo_paciente($_GET["n_recibo"],$_GET["n_venta"],$_GET["id_paciente"]);
date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$datos_paciente = $reporteria->get_datos_factura_paciente($id_paciente);
$data_orden_desc = $reporteria->get_data_orden_credito($id_paciente,$n_orden);
/////////////RECORRER DATA ORDEN DE DESCUENTO
for ($i=0; $i <sizeof($data_orden_desc) ; $i++) { 
    $monto_orden = $data_orden_desc[$i]["monto"];
    $plazo_credito = $data_orden_desc[$i]["plazo"];
    $cuotas_creditos = $monto_orden/$plazo_credito;
    $inicio_credito = $data_orden_desc[$i]["fecha_inicio"];
    $fin_credito = $data_orden_desc[$i]["fecha_finalizacion"];

    $ref_uno = $data_orden_desc[$i]["ref_uno"];
    $tel_ref_uno = $data_orden_desc[$i]["tel_ref_uno"];
    $ref_dos = $data_orden_desc[$i]["ref_dos"];
    $tel_ref_dos = $data_orden_desc[$i]["tel_ref_dos"];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <style>
      html{
        margin-top: 10px;
        margin-left: 30px;
        margin-right:20px; 
        margin-bottom: 0px;
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
   </style>
  </head>
  <body>

<table style="width: 100%;margin-top:2px">
<tr>
<td width="10%"><img src="images/logooficial.jpg" width="130" height="75"/></td>

<td width="75%">
<table style="width:95%;">

 <tr>
    <td style="text-align:center; font-size:16px";font-family: Helvetica, Arial, sans-serif;><strong>OPTICA AVPLUS S.A de C.V.</strong></td>
  </tr>
  <tr>
    <td  style="text-align: center;margin-top: 0px;color:#0088b6;font-size:13px;font-family: Helvetica, Arial, sans-serif;"><b>ORDEN DE DESCUENTO EN PLANILLA</b></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><?php echo $direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date"></span></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px;font-family: Helvetica, Arial, sans-serif;"><span><strong>Telefono:</strong> <?php echo $telefono;?>&nbsp;&nbsp;&nbsp;</span><span><strong>Whatsapp:</strong> <?php echo $wha;?>&nbsp;&nbsp;&nbsp;<br></span>E-mail: metrocentro@opticaavplussv.com</td>
  </tr>


</table><!--fin segunda tabla-->
</td>
<td width="30%">
<table>
  <tr>
    <td style="text-align:right; font-size:12px"><strong>ORDEN</strong></td>
  </tr>
  <tr>
    <td style="color:red;text-align:right; font-size:14px"><strong >No.&nbsp;<span><?php echo $n_orden; ?></strong></td>
  </tr>
</table><!--fin segunda tabla-->
</td> <!--fin segunda columna-->
</tr>
</table>
<p style="text-align: right;font-size:11px;font-family: Helvetica, Arial, sans-serif;" align="right"><?php echo $dir2.",&nbsp;".$hoy;?></p>
<div style="width:100%;margin-top:0px;font-size:12px;font-family: Helvetica, Arial, sans-serif;">
<!--INICIO GET DATA PACIENTES-->
<?php    
    for($j=0; $j<count($datos_paciente);$j++){ ?>
      <span> <b>EMPRESA:</b>&nbsp; <u><?php echo $datos_paciente[$j]["empresas"]."."?></u></span><br><br>
      <span style="font-size:13px;font-family: Helvetica, Arial, sans-serif;">Por la presente y de confirmidad con el artículo N° 136 del código de trabajo, publicado en el Diario Oficial del 31 de Julio de 1972, autorizo a usted a descontar de mi sueldo mensual que devengo en esta empresa como empleado(a) de la misma; la cantidad de:&nbsp;<b style="color: black"><u><?php echo "$".number_format($monto_orden,2,".",",");?></u></b> en <?php echo $plazo_credito?> cuotas __mensuales de: <b><u><?php echo "$".number_format($cuotas_creditos,2,".",",");?></u></b>, las cuales deberán pagar por mi cuenta a partir de: <u><?php echo date("d-m-Y", strtotime($inicio_credito));?></u> hasta <u><?php echo date("d-m-Y", strtotime($fin_credito));?></u>. Por lo tanto autorizo a que se realicen los pagos en concepto de producto y servicios visuales. <br><br><br>  <b>Atentamente.</b><br><br><br> </span>

  <table width="100%" class="table2">
    <tr>
      <th colspan="45" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:45%" bgcolor="#c5e2f6"><b>NOMBRE COMPLETO</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>FUNCIÓN LABORAL</b></th>
      <th colspan="25" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:25%" bgcolor="#c5e2f6"><b>DUI</b></th>
    </tr>
    <tr>
      <td colspan="45" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:45%;text-align: center"><?php echo $datos_paciente[$j]["nombres"];?></td>
      <td colspan="30" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $datos_paciente[$j]["ocupacion"];?></td>
      <td colspan="25" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:25%;text-align: center"><?php echo $datos_paciente[$j]["dui"];?></td>
    </tr>

    <tr>
      <th colspan="10" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:10%" bgcolor="#c5e2f6"><b>EDAD</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>NIT</b></th>
      <th colspan="15" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:15%" bgcolor="#c5e2f6"><b>TELEFONO</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>TEL. OFICINA</b></th>
      <th colspan="25" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:25%" bgcolor="#c5e2f6"><b>CORREO</b></th>
    </tr>
    <tr>
      <td colspan="10" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:10%;text-align: center"><?php echo $datos_paciente[$j]["edad"]." años";?></td>
      <td colspan="20" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $datos_paciente[$j]["nit"];?></td>
      <td colspan="15" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:15%;text-align: center"><?php echo $datos_paciente[$j]["telefono"];?></td>
      <td colspan="30" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $datos_paciente[$j]["telefono_oficina"];?></td>
      <td colspan="25" style="font-size:12px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:25%;text-align: center"><?php echo $datos_paciente[$j]["correo"];?></td>
    </tr>
    <tr>
      <td colspan="100" style="font-size:12px;border: 1px solid black;font-family: Helvetica, Arial, sans-serif;width:100%">&nbsp;&nbsp;<b>DIRECCIÓN COMPLETA:</b>&nbsp;<?php echo $datos_paciente[$j]["direccion"];?></td>
      
    </tr>
  </table>
<br>    
  <table width="100%" class="table2">
    <tr>
    <th colspan="100" style="color:black;font-size:13px;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><b>DETALLES CRÉDITO</b></th>  
    </tr>
    <tr>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>REFERENCIA 1</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>TEL. REFERENCIA 1</b></th>
      <th colspan="30" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:30%" bgcolor="#c5e2f6"><b>REFERENCIA 2</b></th>
      <th colspan="20" style="color:black;font-size:11px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:20%" bgcolor="#c5e2f6"><b>TEL. REFERENCIA 2</b></th>
    </tr>
    <tr>
      <td colspan="30" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $ref_uno;?></td>
      <td colspan="20" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $tel_ref_uno;?></td>
      <td colspan="30" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:30%;text-align: center"><?php echo $ref_dos;?></td>
      <td colspan="20" style="font-size:11px;border: 1px solid :black;font-family: Helvetica, Arial, sans-serif;width:20%;text-align: center"><?php echo $tel_ref_dos;?></td>
    </tr>
    <?php $detalle_orden_desc = $reporteria->get_detalle_orden_credito($id_paciente,$n_orden);
      /*for ($i=0; $i <sizeof($detalle_orden_desc) ; $i++) { 
         echo $detalle_orden_desc[$i];
      }*/
      print_r($detalle_orden_desc);
      print_r($data_orden_desc);
    ?>
    <tr>
      <td colspan="100" style="font-size:12px;border: 1px solid black;font-family: Helvetica, Arial, sans-serif;width:100%">&nbsp;&nbsp;<b>SERVICIO QUE RECIBIÓ:&nbsp;&nbsp;</b><?php foreach($detalle_orden_desc as $row){
        echo strtoupper($row["producto"])."&nbsp;&nbsp;-&nbsp;&nbsp;";
      }?></td>
    </tr>

  </table>
<br><br><br><br>    
<table width="100%">
  <tr>
    <td colspan="50"style="text-align: center"><u>______________________________________</u></td>
    <td colspan="50"style="text-align: center"><u>______________________________________</u></td>
  </tr>
  <tr>
    <td colspan="50"style="text-align: center">Firma del solicitante</td>
    <td colspan="50"style="text-align: center">Firma y sello Óptica AV Plus</td>
  </tr>
</table>  
<!--FIN INICIO GET DATA PACIENTES-->
<?php }?>
 <br>
 <br>
 <br> 
 
</div><!--Fin primera parte-->
</body>
</html>
<?php
$salida_html = ob_get_contents();

  //$user=$_SESSION["id_usuario"];

  ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>