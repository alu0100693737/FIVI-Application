<?php
//Cambia por los detalles de tu base datos
	$dbserver = "mysql.hostinger.es";
	$dbuser = "u261167719_root";
	$password = "sistemas";
	$dbname = "u261167719_temas";
    
//    $dbserver = "localhost";
//	$dbuser = "root";
//	$password = "";
//	$dbname = "temas";
    
    $tema = $_GET['tema'];
    $database = new mysqli($dbserver, $dbuser, $password, $dbname);

	if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
    }

	$jsondata = "";
	
	$sql = "INSERT INTO `temas`(`Id`, `NombreTema`) VALUES (NULL,'".$tema."')";

    if (mysqli_query($database, $sql)) {
        $jsondata["message"] =  "Tema creado correctamente";
    } else {
        $jsondata["message"] = "Error: " . $sql . "<br>" . $database->error;
    }
    $database->close();
	
/*convierte los resultados a formato json*/
$resultadosJson = json_encode($jsondata);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
//echo $resultadosJson;

?>