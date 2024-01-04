<?php

require_once("BiciElectrica.php");

function cargabicis():array{
    $fich=fopen("Bicis.csv","r");
    if($fich==false){
        die("Error al abrir el fichero");
    }
    $tabla=[];

    while($valor=fgetcsv($fich)){
        $bici = new BiciElectrica();
        $bici->id = $valor[0];
        $bici->coordx = $valor[1];
        $bici->coordy = $valor[2];
        $bici->bateria = $valor[3];
        $bici->operativa = $valor[4];
        $tabla[] = $bici;
    }

    return $tabla;
}

function mostrartablabicis($tabla):string{
    $cadena="<table><tr><th>Id</th><th>Coord X</th><th>Cood Y</th><th>Bateria</th></th></tr>";

    foreach($tabla as $bici){
        if($bici->operativa == 1){
            $cadena .= "<td>" . $bici->id . "</td>";
            $cadena .= "<td>" . $bici->coordx . "</td>";
            $cadena .= "<td>" . $bici->coordy . "</td>";
            $cadena .= "<td>" . $bici->bateria . "%</td>";
            $cadena .= "</tr>";
        }
    }
    $cadena.="</table>";
    
    return $cadena;
}

function bicimascercana($x,$y,$tabla){
    $bicicerca = null;
    $distanciamin = PHP_INT_MAX;

    foreach ($tabla as $bici){
        if($bici->operativa == 1){
            $longitud = $bici->distancia($x,$y);
            if($longitud < $distanciamin){
                    $bicicerca= $bici;
                    $distanciamin = $longitud;
            }
        }
    }
    return $bicicerca;
}

?>