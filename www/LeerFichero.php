<?php
header('Content-Type: text/html; charset=UTF-8');
$pregunta = $_GET["pregunta"];
$contenido = explode(" ",$pregunta);
$preguntaFinal = explode("?",$contenido[count($contenido)-1]);
$fichero = fopen("CorpusExamen.txt","r");
$linea="";
$encontrada=false;
while(!feof($fichero) && ($encontrada==false)){
    $linea = fgets($fichero);
    $encontrada= strpos($linea, $preguntaFinal[0]);  
}
if($encontrada === false){
       
        $jsondata["message"] = "No tengo informacion para contestar a esa pregunta";
    }else{
        
        
        $jsondata["message"] = $linea;
}

fclose($fichero);
      
$resultadosJson = json_encode($jsondata);
      
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    
?>