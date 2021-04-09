<?php ob_start();

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){
require_once("modelos/Reporteria.php");
$reporteria=new Reporteria();
$pacientes_cobro = $reporteria->get_pacientes_orden_cobro($_GET['numero_orden']);

for($j=0; $j<count($pacientes_cobro);$j++){
	echo $pacientes_cobro[$j]["nombres"]."$".$pacientes_cobro[$j]["monto_abono"]."<br>";
}

?>

<html>
	<body>
		<?php 
         
		?>
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
<?php  } else{

     header("Location: index.php");
  }?>