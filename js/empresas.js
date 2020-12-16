var tabla_empresas;

function init(){
	listar_empresas();
}

function ocultar_btn_editar(){
  document.getElementById("edit_empresa").style.display = "none";
}
function hidden_btn_guardar(){
  document.getElementById("save_empresa").style.display = "none";
}
function show_btn_editar(){
  document.getElementById("edit_empresa").style.display = "block";
}
function show_btn_guardar(){
  document.getElementById("save_empresa").style.display = "block";
}

function guardarEmpresa(){
	var nomEmpresa=$("#nomEmpresa").val();
	var dirEmpresa=$("#dirEmpresa").val();
	var nitEmpresa=$("#nitEmpresa").val();
	var telEmpresa=$("#telEmpresa").val();
	var respEmpresa=$("#respEmpresa").val();
	var correoEmpresa=$("#correoEmpresa").val();
	var encargado=$("#encargado").val();
	var giro=$("#giroEmpresa").val();
	var registro=$("#registroEmpresa").val();
	
	if(nomEmpresa !="" && dirEmpresa !="" && nitEmpresa !="" || telEmpresa !="" || respEmpresa !="" || correoEmpresa !="" || encargado !=""){
		$.ajax({
			url:"ajax/empresas.php?op=guardar_empresa",
			method:"POST",
			data:{nomEmpresa:nomEmpresa, dirEmpresa:dirEmpresa, nitEmpresa:nitEmpresa, telEmpresa:telEmpresa, respEmpresa:respEmpresa, correoEmpresa:correoEmpresa, encargado:encargado,giro:giro,registro:registro},
			cache: false,
			dataType: "json",
			error:function(x,y,z){
				d_pacole.log(x);
				console.log(y);
				console.log(z);
			},
			success:function(data){
				console.log(data);
      			if(data=='error'){
        		Swal.fire('Empresa ya Existe!','','error')
        		return false;
      			}else if (data=="ok") {
        			Swal.fire('Se ha creado una nueva Empresa!','','success')
        			setTimeout ("explode();", 2000);
			}

		}
	});
}
}

function listar_en_pacientes(){

	tabla_en_pacientes=$('#lista_pacientes_data_emp').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		         
		            'excelHtml5',

		            'pdf'
		        ],other branch?

I am trying to use:

git checkout "the commmit to the changed branch" -b "the other branch"

		"ajax":
				{
					url: 'ajax/empresas.php?op=listar_en_pacientes',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();
}

/////////////RELLENAR LA EMPRESA DE PACIENTE EMPRESARIAL
function agregar_empresa_pac(id_empresa){      
$.ajax({
	url:"ajax/empresas.php?op=buscar_empresa_paciente",
	method:"POST",
	data:{id_empresa:id_empresa},
	dataType:"json",
	success:function(data){                       
		$('#empresasModal').modal('hide');		
		$('#empresa').val(data.nombre);	
	}
})

}

	
/////////LISTAR EMPRESAS
function listar_empresas()
{
  tabla_empresas=$('#data_empresas_creadas').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      responsive: true,
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: 'ajax/empresas.php?op=listar_empresas',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,//Por cada 10 registros hace una paginación
      "order": [[ 0, "desc" ]],//Ordenar (columna,orden)

      "language": {

          "sProcessing":     "Procesando...",

          "sLengthMenu":     "Mostrar _MENU_ registros",

          "sZeroRecords":    "No se encontraron resultados",

          "sEmptyTable":     "Ningún dato disponible en esta tabla",

          "sInfo":           "Mostrando un total de _TOTAL_ registros",

          "sInfoEmpty":      "Mostrando un total de 0 registros",

          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",

          "sInfoPostFix":    "",

          "sSearch":         "Buscar:",

          "sUrl":            "",

          "sInfoThousands":  ",",

          "sLoadingRecords": "Cargando...",

          "oPaginate": {

              "sFirst":    "Primero",

              "sLast":     "Último",

              "sNext":     "Siguiente",

              "sPrevious": "Anterior"

          },

          "oAria": {

              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",

              "sSortDescending": ": Activar para ordenar la columna de manera descendente"

          }

         }//cerrando language

  }).DataTable();
}

function show_datos_empresa (id_empresa){

		$.ajax({
		url:"ajax/empresas.php?op=show_datos_empresa",
		method:"POST",
		data:{id_empresa:id_empresa},
		cache:false,
		dataType:"json",
		success:function(data){				
		$("#id_empresa").val(data.id_empresa);
		$("#nomEmpresa").val(data.nombre);
		$("#dirEmpresa").val(data.ubicacion);
		$("#nitEmpresa").val(data.nit);
		$("#registroEmpresa").val(data.registro);
		$("#giroEmpresa").val(data.giro);
		$("#telEmpresa").val(data.telefono);
		$("#respEmpresa").val(data.responsable);
		$("#correoEmpresa").val(data.correo);
		$("#encargado").val(data.encargado_optica);
		}
	})

}

///////////////EDITAR PACIENTE
function editar_empresa(){
	show_btn_editar();
	hidden_btn_guardar();
	$('.modal-title').text("Editar Empresa");
	var element= document.getElementById("head");
    element.classList.add("bg-secondary");

    var elements= document.getElementById("edit_empresa");
    elements.classList.add("bg-success");
}

function destroy_edits(){
	explode();
}

function save_empresa() {

	var id_empresa =$("#id_empresa").val();
    var nomEmpresa=$("#nomEmpresa").val();
    var dirEmpresa=$("#dirEmpresa").val();
	var nitEmpresa=$("#nitEmpresa").val();
	var telEmpresa=$("#telEmpresa").val();
	var respEmpresa =$("#respEmpresa").val();
	var correoEmpresa=$("#correoEmpresa").val();
	var encargado=$("#encargado").val();	
	var giro=$("#giroEmpresa").val();    
	if(edad !=""){
    $.ajax({
    url:"ajax/empresas.php?op=guardar_empresa",
    method:"POST",
    data:{id_empresa:id_empresa,nomEmpresa:nomEmpresa,dirEmpresa:dirEmpresa,nitEmpresa:nitEmpresa,telEmpresa:telEmpresa,respEmpresa:respEmpresa,correoEmpresa:correoEmpresa,encargado:encargado,giro:giro},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },        
      
  success:function(data){
  	console.log(data);

  if(data=='ok'){
    setTimeout ("Swal.fire('Paciente guardado Existosamente','','success')", 100);
    setTimeout ("explode();", 2000); 
  }else if(data=='nombre'){
    setTimeout ("Swal.fire('La empresa ya existe en la base de Datos','','error')", 100);
    return false;           
 }else if(data="editado"){
	setTimeout ("Swal.fire('Guardado Existosamente','','success')", 100);
    setTimeout ("explode();", 2000); 
}
}
});
}else{
	setTimeout ("Swal.fire('Hay campos obligatorios sin llenar','','error')", 100);
}
//cierre del condicional de validacion de los campos de empresa
}


///////////
function eliminar_empresa(id_empresa){
	  
	bootbox.confirm("¿Está Seguro de eliminar Empresa?", function(result){
    if(result){

	$.ajax({
		url:"ajax/empresas.php?op=eliminar_empresa",
		method:"POST",
		data:{id_empresa:id_empresa},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			if(data=="ok"){
				setTimeout ("Swal.fire('Empresa Eliminado Existosamente','','success')", 100);
			}else if(data=="existe"){
				setTimeout ("Swal.fire('Existen pacientes asociados a esta empresa','','error')", 100);
			}						//alert(data);
			$("#data_empresas_creadas").DataTable().ajax.reload();
		}
	});

}
});//bootbox

}

init();

function explode(){
    location.reload();
