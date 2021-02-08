<style>
    #envio_tam{
      max-width: 70% !important;
    }
</style>    
<div class="modal fade" id="detalles_orden_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="envio_tam">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DETALLE ORDEN DE LABORATORIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <div class="form-row">

      <div class="form-group col-md-2">
        <label>#Orden</label>
        <input type="text" class="form-control" id="n_orden_det" readonly>
      </div>

      <div class="form-group col-md-4">
        <label>Titular</label>
        <input type="text" class="form-control" id="titular_det" readonly>
      </div>

      <div class="form-group col-md-4">
        <label>Servicio para</label>
        <input type="text" class="form-control" id="evaluado_det" readonly>
      </div>

      <div class="form-group col-md-2">
        <label>Laboratorio</label>
        <input type="text" class="form-control" id="laboratorio_det" readonly>
      </div>      

      </div><!--Fin Form Row-->

<div class="eight">
  <strong><h1 style="color: #034f84">GRADUACIÓN Y MEDIDAS</h1></strong>
  <div class="row">
  <div class="col-sm-6">    
  <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>      
        <th style="text-align:center">ADICION</th>
        <th style="text-align:center">PRISMA</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odesferasf_orden_det" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odcilindrosf_orden_det" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odejesf_orden_det" readonly="" style="text-align: center"></td>             
        <td> <input type="text" class="form-control clear_orden_i"  id="oddicionf_orden_det" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odprismaf_orden_det" readonly="" style="text-align: center"></td>                
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiesferasf_orden_det"  readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oicolindrosf_orden_det"  readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiejesf_orden_det"  readonly="" style="text-align: center"></td>              
        <td> <input type="text" class="form-control clear_orden_i"  id="oiadicionf_orden_det" readonly="" style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiprismaf_orden_det" readonly="" style="text-align: center"></td>     
      </tr>
     </tbody>
  </table>
  </div>  
  <div class="col-sm-6" style="margin-left: 0px">
      <table width="100%">
      <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
        <th colspan="5" style="width: 5%"></th>
        <th colspan="5" style="width: 5%;text-align: center">DIP</th>
        <th colspan="5" style="width: 5%;text-align: center">AP</th>
        <th colspan="5" style="width: 5%;text-align: center">AO</th>
      </thead>
      <tr>
        <td colspan="5" style="text-align:right;">OD</td>
        <td colspan="5"><input style="text-align: center" readonly id="dip_od_det" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ap_od_det" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ao_od_det" class="form-control clear_orden_i"></td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right;">OI</td>
        <td colspan="5"><input style="text-align: center" readonly id="dip_oi_det" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ap_oi_det" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center" readonly id="ao_oi_det" class="form-control clear_orden_i"></td>
      </tr>
    </table>
  </div>
</div>
</div>

<div class="eight">
  <h1>TIPO DE LENTE + TRATAMIENTO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">LENTE</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i" id="lente_orden_det" readonly="">
      </div>
    </div>

    <div class="form-group col-sm-7">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">TRATAMIENTOS</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i" id="tratamiento_orden_det" readonly="">
      </div>
    </div>
  </div>
</div>

<div class="eight">
  <h1>ARO</h1>
  <div class="form-row align-items-center row" style="margin: 4px">
    <div class="form-group col-sm-3">
      <label for="">Modelo</label>
      <input type="text" class="form-control clear_orden_i" id="modelo_aro_orden_det" readonly="">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Marca</label>
      <input type="text" class="form-control clear_orden_i" id="marca_aro_orden_det" readonly="">
    </div>

      <div class="form-group col-sm-3">
      <label for="">Color</label>
      <input type="text" class="form-control clear_orden_i" id="color_aro_orden_det" readonly="">
    </div>

    <div class="form-group col-sm-3">
      <label for="">Diseño</label>
      <input type="text" class="form-control clear_orden_i" id="diseno_aro_orden_det" readonly="">
    </div>
  </div>

 <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th  colspan="25" style="text-align:center;width:25%">HORIZONTAL</th>
        <th  colspan="25" style="text-align:center;width:25%">DIAGONAL</th>
        <th  colspan="25" style="text-align:center;width:25%">VERTICAL</th>
        <th  colspan="25" style="text-align:center;width:25%">PUENTE</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" id="med_a_det" readonly=""></td>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" id="med_b_det" readonly=""></td>
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" id="med_c_det" readonly=""></td>     
        <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" id="med_d_det" readonly=""></td>                
      </tr>
  </table>

  <div class="form-group col-sm-12">
    <label for="">Observaciones</label>
    <input type="text" class="form-control clear_orden_i" id="observaciones_orden_det" readonly>
  </div>

</div>

      </div><!--Fin de Body-->

    </div>
  </div>
</div>