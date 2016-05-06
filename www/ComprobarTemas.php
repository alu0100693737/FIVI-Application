<?php
//Cambia por los detalles de tu base datos
	$dbserver = "mysql.hostinger.es";
	$dbuser = "u119411850_root";
	$password = "sistemas";
	$dbname = "u119411850_temas";
//    $dbserver = "localhost";
//	$dbuser = "root";
//	$password = "";
//	$dbname = "temas";


        $database = new mysqli($dbserver, $dbuser, $password, $dbname);

	if($database->connect_errno) {
                die("No se pudo conectar a la base de datos");
	}

	$jsondata = array();

	if ( $result = $database->query( "SELECT NombreTema FROM temas") ) {

		if( $result->num_rows > 0 ) {


                     $jsondata["temas"] = array();
                     while( $row = $result->fetch_object() ) {
                                $jsondata["temas"][] = $row;
                     }

		}



		$result->close();

	}

/*convierte los resultados a formato json*/
$resultadosJson = json_encode($jsondata);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
//echo $resultadosJson;

?>
