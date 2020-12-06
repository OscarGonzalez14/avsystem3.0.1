function guardar_accesorios(){
	//se definen las variables según los campos del modal guardar accesorios

	var marca_accesorio=$("#marca_accesorio").val();
	var des_accesorio=$("#des_accesorio").val();
	var tipo_accesorio=$("#tipo_accesorio").val();
	


		$.ajax({
		url:"ajax/accesorios.php?op=guardar_accesorios",
		method:"POST",
		data:{marca_accesorio:marca_accesorio, des_accesorio:des_accesorio, tipo_accesorio:tipo_accesorio},
		cache:false,
		dataType:"json",
		error:function(x,y,z){
		d_pacole.log(x);
		console.log(y);
		console.log(z);
		},
			success:function(data){
		setTimeout ("Swal.fire('Se ha registrado un nuevo usuario','','success')", 100)
        setTimeout ("explode();", 2000);
    		
   		}
		});
		
	}	

function explode(){
    location.reload();
  }
