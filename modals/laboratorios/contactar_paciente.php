<style>
    #c_contact_tam{
      max-width: 60% !important;
    }

    .ord_1{
      width: 25%;
      color: white;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      background: #004080;
      width: 25%;
    }
    .ord_2{
      width: 25%;
      color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;
      text-align: center;
      width: 25%;
    }
    .table2 {
       border-collapse: collapse;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       text-align: center;
    }   
</style>
<div class="modal fade" id="contactos_pac_orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" id="c_contact_tam">
    <div class="modal-content">
      <div class="modal-body">
        CONTACTAR PACIENTES
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            <div class="">
              <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <!--<div class="float-left" style="text-transform: uppercase;"><b>Paciente evaluado:&nbsp;</b><span>Oscar Antonio gonzalez</span></div><div class="float-right" style="text-transform: uppercase;"><b>Titular:&nbsp;</b> <span>Rosario Guadalupe</span></div><br>
                    <div style="display: flex;justify-content:space-between;"><b>Celular:</b> <span id="cel_orden"></span><b>Correo:</b> <span id="cel_orden"></span></div>-->
                    <table width="100%" class="table2">
                      <thead>
                        <th bgcolor="#0061a9" colspan="34" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:34%" class="stilot1">Evaluado</th>
                        <th bgcolor="#0061a9" colspan="34" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:34%" class="stilot1">Titular</th>
                        <th bgcolor="#0061a9" colspan="32" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:32%" class="stilot1">Empresa</th>
                      </thead>
                      <tr>
                        <td colspan="34" style="width: 34%" class="stilot1">Oscar Antonio Gonzalez</td>
                        <td colspan="34" style="width: 34%" class="stilot1">Rosario Guadalupe Rojas</td>
                        <td colspan="32" style="width: 32%" class="stilot1">Prado El Slavador</td>
                      </tr>

                      <thead>
                        <th bgcolor="#0061a9" colspan="34" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:34%" class="stilot1">Celular</th>
                        <th bgcolor="#0061a9" colspan="34" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:34%" class="stilot1">Telefono oficina</th>
                        <th bgcolor="#0061a9" colspan="32" style="color:white;font-size:12px;border: 1px solid #034f84;font-family: Helvetica, Arial, sans-serif;width:32%" class="stilot1">Correo</th>
                      </thead>
                      <tr>
                        <td colspan="34" style="width: 34%" class="stilot1">Oscar Antonio Gonzalez</td>
                        <td colspan="34" style="width: 34%" class="stilot1">Rosario Guadalupe Rojas</td>
                        <td colspan="32" style="width: 32%" class="stilot1">Prado El Slavador</td>
                      </tr>
                    </table>
                  </li>
                  <li class="list-group-item">
                     <div style="margin:5px" id="observaciones_ca">
                       <label for="exampleFormControlTextarea1">OBSERVACIONES</label>
                       <textarea class="form-control" id="observaciones_contacto" rows="2"></textarea>
                      </div>
                  </li>
                  <li class="list-group-item">
                    Notas:
                  </li>
                </ul>
                 <input type="hidden" id="id_pac_contact">
                 <input type="hidden" id="n_orden_contact">
                <a class="btn btn-dark btn-block" onClick="registrar_contacto();"><b>REGISTRAR ACCIÓN</b></a>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
    </div>
  </div>
</div>