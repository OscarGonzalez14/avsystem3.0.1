
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

</body>
</html>

<!-- PARA BUSCAR POR FECHA DONDE FECHA ES UN STRING
SELECT * FROM existencias where categoria_ub like "EX-3" and STR_TO_DATE(fecha_ingreso, '%d-%m-%Y') < STR_TO_DATE("09-02-2021",'%d-%m-%Y')

-->

         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Ordenes de Desc.
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-danger right">.</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="desc_planilla.php" class="nav-link">
                  <i class="far fa-file"></i>
                  <p>Descuentos en Planilla</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargos Automaticos</p>
                </a>
              </li>

            </ul>
          </li>