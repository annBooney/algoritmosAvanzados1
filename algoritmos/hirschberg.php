<?php
    
    /**
     * Calcula la última fila de la tabla de programación dinámica usando
     * solo 0(m) espacio.
     * @param string $X La primera cadena.
     * @param string $Y La segunda cadena.
     * @return array Lista donde resultado[j] es la longitud del LCS de X y Y[0..j-1].
     */
    function lcs_longitud_espacio_lineal($X, $Y) {
        $n = strlen($X);
        $m = strlen($Y);

        $fila_anterior = array_fill(0, $m + 1, 0);
        $fila_actual = array_fill(0, $m + 1, 0);

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= $m; $j++) {
                if ($X[$i] === $Y[$j]) {
                    $fila_actual[$j + 1] = $fila_anterior[$j] + 1;
                } else {
                    $fila_actual[$j + 1] = max($fila_actual[$j], $fila_anterior[$j + 1]);
                }
            }

            $temp = $fila_anterior;
            $fila_anterior = $fila_actual;
            $fila_actual = array_fill(0, $m + 1, 0);
        }

        return $fila_anterior;
    }

    
    /**
     * Algoritmo de Hirschberg para encontrar el LCS usando espacio lineal.
     * ESTRATEGIA: Divide y vencerás.
     * 1. Si X o Y son pequeños, usar método simple
     * 2. Dividir X en dos mitades.
     * 3. Encontrar 
     * @param string $X La primera cadena.
     * @param string $Y La segunda cadena.  
     * @return string La subsecuencia común más larga entre X e Y.
     */
    function hirschberg($X, $Y) {
        $n = strlen($X);
        $m = strlen($Y);

        if($n == 0 || $m == 0) {
            return "";
        } 

        if($n == 1) {
            if(strpos($Y, $X) !== false) {
                return $X;
            } else {
                return "";
            }
        }

        $mitad = intdiv($n, 2);
        $X_izq = substr($X, 0, $mitad);
        $X_der = substr($X, $mitad);

        $L1 = lcs_longitud_espacio_lineal($X_izq, $Y);
        $L2 = lcs_longitud_espacio_lineal(strrev($X_der), strrev($Y));
        $k = 0;
        $max = 0;
        for ($j = 0; $j <= $m; $j++) {
            $suma = $L1[$j] + $L2[$m - $j];
            if ($suma > $max) {
                $max = $suma;
                $k = $j;
            }
        }
        $Y_izq = substr($Y, 0, $k);
        $Y_der = substr($Y, $k);
        
        return hirschberg($X_izq, $Y_izq) . hirschberg($X_der, $Y_der);
    }

    /**
     * Función principal para calcular LCS usando el algoritmo de Hirschberg.
     * @param string $X La primera cadena.  
     * @param string $Y La segunda cadena.
     * @return array Un array que contiene la longitud del LCS y la propia subsecuencia.
     */
    function lcs_hirschberg($X, $Y) {
        $lcs = hirschberg($X, $Y);
        return array(strlen($lcs), $lcs);
    }

?>