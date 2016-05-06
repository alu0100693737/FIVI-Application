<?php
header('Content-Type: text/html; charset=UTF-8');
$pregunta = $_GET["pregunta"];
$temaElegido = $_GET["temaElegido"];
$nombreFichero = $temaElegido.".txt";

$preguntaOinformacion= substr($pregunta, -1);

if($preguntaOinformacion != "?"){
    $fichero = fopen("docs/".$nombreFichero,"a");
    fputs($fichero, $pregunta."\r\n");
    $jsondata["message"] = "Información añadida correctamente";
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


            $jsondata["message"] = $linea;
    }
}
fclose($fichero);
      
$resultadosJson = json_encode($jsondata);
//echo $resultadosJson;      
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    
?>