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
var array = [
  {id: "6051", nombre: "T CC COMERCIAL", pendiente: "15 und", ejecutado: "50 M", fabrica: "35 und"},
  {id: "6618", nombre: "T. OCCIDENTE", pendiente: "15 und", ejecutado: "50 M", fabrica: "35 und"},
  {id: "6668", nombre: "T GENTE BBVA", pendiente: "15 und", ejecutado: "50 M", fabrica: "35 und"}
];
//let index = array.findIndex(function(el){
//  return el.id == 6618; // or el.nombre=='T NORTE';

//console.log(index);

//var array = [3, 5, 9];
//var index = array.indexOf(5);
function delete_element() {
  /*if (index > -1) {
   array.splice(index, 1);
}*/
let index = array.findIndex(function(el){
  return el.id == 6668; // or el.nombre=='T NORTE';
});
console.log(index);
}
</script>

</body>
</html>