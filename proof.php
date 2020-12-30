<?php

$fecha_actual = "2021-01-10";

//sumo 1 mes
echo date("d-m-Y",strtotime($fecha_actual."+ 1 month"))."<br>"; 
//resto 1 mes
echo date("d-m-Y",strtotime($fecha_actual."- 1 month"))."<br>";

$fecha_actual = date("d-m-Y");
//sumo 1 mes
echo date("d-m-Y",strtotime($fecha_actual."+ 1 month"))."<br>"; 
//resto 1 mes
echo date("d-m-Y",strtotime($fecha_actual."- 1 month"))."<br>";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 	Hemos agregadpo codigo HTML al archivo
</body>
</html>