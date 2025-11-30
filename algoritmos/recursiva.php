<?php

/**
 * Calcula la longitud y la subsecuencia común más larga (LCS) entre dos cadenas
 * utilizando un enfoque recursivo directo.
 * @param string $X La primera cadena.
 * @param string $Y La segunda cadena.
 * @param int $i Índice actual en la primera cadena (desde srtlen(X)-1).
 * @param int $j Índice actual en la segunda cadena (desde strlen(Y)-1).
 * @return array Un array que contiene la longitud del LCS y la propia subsecuencia.
 */
function lcs_recursiva_longitud($X, $Y, $i = null, $j = null) {
    if ($i === null) $i = strlen($X) - 1;
    if ($j === null) $j = strlen($Y) - 1;

    if ($i < 0 || $j < 0) {
        return 0;
    }

    if ($X[$i] === $Y[$j]) {
        return 1 + lcs_recursiva_longitud($X, $Y, $i - 1, $j - 1);
    } 

    $opcion_a = lcs_recursiva_longitud($X, $Y, $i - 1, $j);
    $opcion_b = lcs_recursiva_longitud($X, $Y, $i, $j - 1);
    
    return max($opcion_a, $opcion_b);
}

/**
 * Reconstruye la subsecuencia común más larga (LCS) entre dos cadenas.
 * @param string $X La primera cadena.
 * @param string $Y La segunda cadena.
 * @param int $i Índice actual en la primera cadena.
 * @param int $j Índice actual en la segunda cadena.
 * @return string La subsecuencia común más larga.
 */
function reconstruir_lcs_recursivo($X, $Y, $i, $j) {
    if( $i < 0 || $j < 0) {
        return "";
    }

    if ($X[$i] === $Y[$j]) {
        return reconstruir_lcs_recursivo($X, $Y, $i - 1, $j - 1) . $X[$i];
    }
    
    if(lcs_recursiva_longitud($X, $Y, $i - 1, $j) >= lcs_recursiva_longitud($X, $Y, $i, $j - 1)) {
        return reconstruir_lcs_recursivo($X, $Y, $i - 1, $j);
    } else {
        return reconstruir_lcs_recursivo($X, $Y, $i, $j - 1);
    }
}


/**
 * Función principal para calcular LCS usando el enfoque recursivo.
 * Muy lento para cadenas largas.
 * @param string $X La primera cadena.
 * @param string $Y La segunda cadena.
 * @return array Un array que contiene la longitud del LCS y la propia subsecuencia.
 */
function lcs_recursiva($X, $Y) {
    $n = strlen($X);
    $m = strlen($Y);

    $longitud = lcs_recursiva_longitud($X, $Y, $n - 1, $m - 1);

    if($n <= 15 && $m <= 15){
        $cadena = reconstruir_lcs_recursivo($X, $Y, $n - 1, $m - 1);
    }else{
        $cadena = "[No calculado por ser cadenas muy largas]";
    }   
    
    return array($longitud, $cadena);
}

?>