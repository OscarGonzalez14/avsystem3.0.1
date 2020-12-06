<style type="text/css">
  #tamModal_con{
  max-width: 95% !important;
  }
  #head{
  background-color: black;
  color: white;
  text-align: center;
}
body.modal-open {
    position: fixed;
    overflow: hidden;
    left:0;
    right:0;
}
.modal{
    -webkit-overflow-scrolling: auto;
}
</style>
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- The Modal -->
<div class="modal fade" id="consultasModal">
  <div class="modal-dialog" id="tamModal_con">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h5 class="modal-title" align="center">CONSULTAS</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">        
        
          <form class="form-horizontal" method="post" action="ajax/reg_consulta.php">
            <input class="form-control" id="id_paciente" name="" type="hidden" readonly>
            <div class="form-group row">

             <div class="col-sm-3">
               <label for="ex3">Encargado de Cuenta</label>
                <input class="form-control" id="nombre_pac" type="text" name="nombre_pac" readonly>
              </div>

            <div class="col-sm-3">
              <label for="ex3">Paciente evaluado&nbsp;&nbsp;&nbsp;<input class="quimica" type="checkbox" name="check_box" id="editar_eval" onClick="habilita_edit_eval();"> Editar</label>
              <input class="form-control" id="p_evaluado" type="text" name="p_evaluado" onkeyup="mayus(this);"readonly>
            </div>

            <div class="col-sm-2">
              <label for="ex1">Parentesco</label>
              <input class="form-control" id="parentesco_evaluado" name="parentesco_evaluado" type="text" onkeyup="mayus(this);">
            </div>

            <div class="col-sm-2">
              <label for="ex3">Telefono</label>
              <input class="form-control" id="tel_evaluado" type="text" name="tel_evaluado" placeholder="Paciente Evaluado">
            </div>
            <?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
            <div class="col-sm-2">
              <label for="ex3">Fecha de Consulta</label>
              <input class="form-control" id="fecha_consulta" type="text" name="fecha_consulta" placeholder="dd/mm/YY" value="<?php echo $hoy;?>" readonly>
            </div>

            <div class="col-sm-12">
            <label for="comment">Motivo de Consulta</label>
            <textarea cols="80" class="form-control" rows="1" id="motivo" name="motivo"></textarea>
            </div>

            <div class="col-sm-12">
              <label for="comment">Patologias</label>
              <textarea cols="80" class="form-control" rows="1" id="patologias" name="patologias"></textarea>
            </div>

            <div class="dropdown-divider"></div>
<div class="lens-auto" style="display:flex">
<hr style="color:blue;">
    
<div class="lenso" style="margin:5px">
<h5 style="color:blue;text-align:center"><strong>Lensometria</strong></h5>
<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">

    <thead class="thead-light bg-secondary">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilndrosl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odprismal"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odadicionl" id="odadicionl" onKeyup="fill_lenso_oi()"></td>
        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesfreasl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicilindrosl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismal" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionl" id="oiadicionl"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN LENSO-->
<hr style="color:blue;">
<div class="autorefract" style="margin:5px">


<table style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <h5 style="color:blue;text-align:center"><strong>Autorefractometro</strong></h5>
    <thead class="thead-light bg-primary">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddiciona"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaa"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadiciona"></td>
      </tr>
      
    </tbody>
  </table>
</div><!--FIN AUTOREFRACT-->
</div>

 <!--==================== FIN Autorefractometro==================-->
  <!--==================== Rx Final==================-->
<div class="final-agudeza" style="display:flex">
  <!--==================== AgudezaVisual==================-->
<div class="aguvisual" style="margin:5px">
<table style="border: solid 2px gray;border-radius:8px;width:100%">
<div><center><h5 style="color:blue;"><strong>Agudeza Visual</strong></h5></center></div>
    <thead class="thead-light">
    <tr>
    <td colspan="1">.</td>
      <td style="text-align:center;" colspan="3">VISION LEJANA</td>
      <td style="text-align:center; background-color:#E0E0E0" colspan="2">VISION CERCANA</td>
    </tr>

      <tr>
        <th style="text-align:center" colspan="1">OJO</th>
        <th style="text-align:center" colspan="1">S/C</th>
        <th style="text-align:center" colspan="1">PH</th>
        <th style="text-align:center" colspan="1">C/C</th>
        <th style="text-align:center;background-color:#E0E0E0" colspan="1">S/C</th>
        <th style="text-align:center;background-color:#E0E0E0" colspan="1">C/C</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavsclejos"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavphlejos"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odavcclejos"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="odavsccerca"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="odavcccerca"></td>
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavcolindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiavejesf"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="oiavprismaf"></td>
        <td style="background-color:#E0E0E0"> <input type="text" class="form-control" placeholder="---" name="oiavadicionf"></td>
      </tr>
  </tbody>
  </table>
  </div>

  <!--==================== FIN AgudezaVisual==================-->

<div class="rxfinal" style="margin:5px">
<table style="border: solid 2px gray;border-radius:8px;width:100%">
<div><center><h5 style="color:blue;"><strong>RX Final</strong></h5></center></div>
    <thead class="thead-light bg-primary">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">CORRIGE</th>
        <th style="text-align:center">ADICION</th>
        <th style="text-align:center">CORRIGE</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="dprismaf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="prisodcorrige"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oddicionf" id="oddicionf" onKeyup="fill_rx()"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="addodcorrige" id="addodcorrige"></td>        
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiesferasf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oicolindrosf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiejesf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismaf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="prisoicorrige"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionf" id="oiadicionf"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="addoicorrige"></td>
      </tr>
    <tr style="display:hidden">
      <td colspan="1" style="display:hidden"></td>
      <td style="text-align:center;display:hidden" colspan="3"></td>
      <td style="text-align:center;display:hidden" colspan="4"><span style="color:white">.</span></td>
    </tr>
  </table>

  </div>
  <!--rxfinal-->
</div><!--fin agudezaVisual Rxfinal-->
<!--=======OBLEAS=======-->
<div class="" style="margin:5px">

<table class="table" style="border: solid 2px gray;border-radius:8px;width:100%" width="100%">
    <tr>
        
        <td> <input type="text" class="form-control" placeholder="DIP" name="dip" id="dip" onKeyup="fill_obleas()"></td>
        <td> <input type="text" class="form-control" placeholder="OD" name="oddip" id="oddip"></td>
        <td> <input type="text" class="form-control" placeholder="OI" name="oidip" id="oidip"></td>
        <td>AO</td>
        <td><input type="text" class="form-control" placeholder="OD" name="aood" id="aood" onKeyup="fill_ao()"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="aooi" id="aooi"></td>
        <td>AP</td>
        <td><input type="text" class="form-control" placeholder="OD" name="apod" id="apod" onKeyup="fill_ap()"></td>
        <td><input type="text" class="form-control" placeholder="OI" name="opoi" id="opoi"></td>
      </tr>      
  </tbody>
  </table>
</div>
<!--======= FIN OBLEAS=======-->
<div class="col-sm-12">
    <label for="ex3">Test de ISHIHARA</label>
    <input class="form-control" id="ishihara" type="text" name="ishihara" placeholder="Lentes sugeridos">
</div>

<div class="col-sm-12">
    <label for="ex3">Test de AMSLER</label>
    <input class="form-control" id="amsler" type="text" name="amsler" placeholder="Lentes sugeridos">
</div>

<div class="col-sm-12">
    <label for="ex3">Superficie Ocular y Anexos</label>
    <input class="form-control" id="anexos" type="text" name="anexos" placeholder="Lentes sugeridos">
</div>

<div class="col-sm-12">
  <label for="ex3">Lentes Sugeridos</label>
  <input class="form-control" id="sugeridos" type="text" name="sugeridos" placeholder="Lentes sugeridos">
</div>

<div class="col-sm-12">
  <label for="comment">Diagnostico</label>
  <textarea cols="80" class="form-control" rows="2" id="diagnostico" name="diagnostico" placeholder="Diagnostico"></textarea>
</div>

<div class="col-sm-12">
  <label for="ex3">Medicamento</label>
  <input class="form-control" id="medicamento" type="text" name="medicamento" placeholder="Medicamento">
</div>

<div class="col-sm-12">
  <label for="comment">Observaciones</label>
  <input class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones" required>
</div>
<input class="form-control" id="codigop" name="codigop" type="hidden" readonly>
<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
</div><!--FIN FORM-GROUP-->
<button type="submit" id="agregar" name="agregar" class="btn btn-blue btn-block" id="addCons"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
Guardar</button>
</form>  
</div><!--FIN MODAL BODY-->
      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
