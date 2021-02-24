
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="row row 1"><!--Inicio row 1-->
    <div class="col-sm4"></div>
    <div class="col-sm4"><button onClick="delete_element();">Eliminar</button></div>
    <div class="col-sm4"></div>
  </div><!-- Fin Inicio row 1-->
  
  <section class="botones-de-venta">
    
  </section><!--Fin botones de Venta-->

  <script>
cadena = "perro,gato,tucán";
var arreglo =cadena.split(",");
console.log(cadena);
console.log(arreglo);
</script>
<?php 

$array = array("Muffinhead", "Peter", "Monnie", "Banh");
  $html= "
     <thead class='bg-success'>
      <th style='text-align:center'>Producto</th>
      <th style='text-align:center'>Cantidad</th>
      <th style='text-align:center'>P/U</th>
      <th style='text-align:center'>Descuento $</th>
      <th style='text-align:center'>Subtotal</th>                                   
    </thead>";
  foreach ($array as &$valor) {
    $animales = [
    "Muffinhead" => 14,
    "Peter" => 4,
    "Monnie" => 7,
    "Banh" => 10
];
    $html .="<tr>
      <td style='text-align:center'>".$valor.":".$animales[$valor]."</td>
      <td style='text-align:center'>".$valor.":".$animales[$valor]."</td>
      <td style='text-align:center'>".$valor.":".$animales[$valor]."</td>
      <td style='text-align:center'>".$valor.":".$animales[$valor]."</td>
      <td style='text-align:center'>".$valor.":".$animales[$valor]."</td>                                   
    </tr>";
  }
 


  ?> 
  <table>
    <?php
    echo $html;
    ?>
  </table>          
</body>
