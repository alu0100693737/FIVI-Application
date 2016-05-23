<?php
header('Content-Type: text/html; charset=UTF-8');
$pregunta = $_GET["pregunta"];
$temaElegido = $_GET["temaElegido"];
$nombreFichero = $temaElegido.".txt";

$preguntaOinformacion= substr($pregunta, -1);

if($preguntaOinformacion != "?"){
    if(strcmp ($temaElegido , "Examenes" ) == 0){
      $fichero = fopen("docs/".$nombreFichero,"a");
      fputs($fichero, $pregunta."\r\n");
      $jsondata["message"] = "Información añadida correctamente";
    }else{
      $jsondata["message"] = "No se puede añadir información sobre este tema";
    }
}else{
    $contenido = explode(" ",$pregunta);
    $preguntaFinal = explode("?",$contenido[count($contenido)-1]);
    $fichero = fopen("docs/".$nombreFichero,"r");
    $linea="";
    $encontrada=false;
    while(!feof($fichero) && ($encontrada==false)){
        $linea = fgets($fichero);
        $encontrada= stripos($linea, $preguntaFinal[0]);
    }
    if($encontrada === false){

            $jsondata["message"] = "No tengo informacion para contestar a esa pregunta";
    }else{

            if(strcmp ($temaElegido , "Examenes" ) == 0){
              $lineaEnPartes = explode(",",$linea);
              $latitudFichero = (double)($lineaEnPartes[1]);
              $longitudFichero = (double)($lineaEnPartes[2]);
              $latitud = (double)($_GET["latitud"]);
              $longitud = (double)($_GET["longitud"]);

              if((($latitudFichero >= ($latitud-0.5)) && ($latitudFichero <= ($latitud+0.5))) && (($longitudFichero >= ($longitud-0.5)) && ($longitudFichero <= ($longitud+0.5)))){
                    $jsondata["message"] = $lineaEnPartes[0];
              }else{
                    $jsondata["message"] = "Frase: ".$lineaEnPartes[0]." latitud: ".$latitud." longitud: ".$longitud." y nosotros latitudFichero: ".$latitudFichero." y longitudFichero: ".$longitudFichero." No hay exámenes registrados en esta zona";
              }
            }else{
              $jsondata["message"] = $linea;
            }
    }
}
fclose($fichero);

$resultadosJson = json_encode($jsondata);
//echo $resultadosJson;
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>
