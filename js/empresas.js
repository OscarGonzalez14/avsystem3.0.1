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
	
	if(nomEmpresa !="" || dirEmpresa !="" || nitEmpresa !="" || telEmpresa !="" || respEmpresa !="" || correoEmpresa !="" || encargado !=""){
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
				alert("¡Los datos han sido guardados exitosamente!");
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
		        ],
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