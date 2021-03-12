<?php
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
require_once('header.php');
date_default_timezone_set('America/El_Salvador'); $hoy = date("Y-m-d");;
?>
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
  <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2" style="margin: 2px">
          <div class="col-sm-5" style="align-items:left">
            <h5><strong><i class="fas fa-file" style="color:green"></i> REPORTE MENSUAL DE VENTAS</strong></h5>
          </div>
          <div class="col-sm-7">
            <ul class="breadcrumb float-sm-right" style="background-color:transparent;padding:0px;">
            <li class="breadcrumb-item"><a href="ventas.php">Nueva Venta</a></li>
            <li class="breadcrumb-item"><a href="corte_diario.php">Corte Diario</a></li>
            <li class="breadcrumb-item active">Reporte Mensual</li>
            <li class="breadcrumb-item"><a href="reporte_gral_ventas.php">Reporte General</a></li>
            </ul>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="row" style="margin:11px;">
          <section>
            <div class="form-row">
              <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-3">
                <label for="fecha_inicial">Desde</label>
                <input type="date" class="form-control float-right rango-fecha" id="fecha_inicial" onClick="rango_fecha();">
              </div>

              <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-3">
                <label for="fecha_final">Hasta</label>
                <input type="date" class="form-control float-right rango-fecha" id="fecha_final" onClick="rango_fecha();">
              </div>

              <div class="form-group col-sm-3">
                <label for="sucursal">Sucursal</label>
                <select id="sucursal" class="form-control">
                  <option selected>Seleccione Sucursal...</option>
                  <option value="Metrocentro">Metrocentro</option>
                  <option value="Santa Ana">Santa Ana</option>
                  <option value="San Miguel">San Miguel</option>
                </select>
              </div>

              <div style="margin-left:5px;margin-right:5px" class="form-group col-sm-2">
                <label for="fecha_final">Mostrar</label>
                <div class="input-group-prepend" onClick="ver_ventas();">
                  <span class="input-group-text" id="basic-addon01" style="background:#001a57;color: white">&nbsp;&nbsp;<i class="fas fa-search">&nbsp;&nbsp;</i></span>
                </div>
              </div>
            </div><!--Fin row 1-->
          </section>
    </div>

  <div class="content" id="listar_reporte_vtas_mensual"><br>

    <div class="card-body p-0" style="margin:7px">
      <table id="lista_reporte_vtas_mensual_data" width="100%" data-order='[[ 0, "desc" ]]' class="table-hover table-striped table-bordered">
        <thead style="background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center">
          <tr>
          <th>ID</th>
          <th>TITULAR</th>
          <th>TIPO VENTA</th>
          <th>TIPO PAGO</th>
          <th>MONTO</th>
          <th>SALDO</th>
          <th>FECHA</th>
          <th>VENDEDOR</th>
          </tr>
        </thead>
        <tbody style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;">                                  
        </tbody>
        <!--<tfoot>
          <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th id="monto_v"></th>
          <th id="monto_s"></th>
          <th></th>
          <th></th> 
          </tr>
        </tfoot>-->
      </table>
    </div>
  </div>
</div>
<?php require_once("footer.php"); ?>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" name="id_usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">

<script src="js/ventas.js"> </script>
<script type="text/javascript" src="js/cleave.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>

<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(function () {
      $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
   })

  const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 3000
  });
</script>
<!-- date-range-picker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#fecha').daterangepicker()
    //Date range picker with time picker
    $('#fechatime').daterangepicker({
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })

    $( "#fecha" ).datepicker({
       format: 'dd-mm-yyyy'
    });
    //Date range as a button
    $('#rango_fecha-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

  function rango_fecha(){
    $( "#fecha" ).datepicker({
       format: 'dd-mm-yyyy'
    });
  }


<?php } else{
    echo "Acceso no permitido";
  } ?>

 
