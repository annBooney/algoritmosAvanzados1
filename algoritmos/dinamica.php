<?php
    
    /**
     * Función principal: Programación Dinámica para calcular LCS.
     * @param string $X La primera cadena.
     * @param string $Y La segunda cadena.
     * @return array Un array que contiene la longitud del LCS y la propia subsecuencia.
     */
    function lcs_dinamica($X, $Y) {
        $n = strlen($X);
        $m = strlen($Y);

        $dp = [];
        for ($i = 0; $i <= $n; $i++) {
            $dp[$i] = array_fill(0, $m + 1, 0);
        }

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= $m; $j++) {
                if ($X[$i - 1] === $Y[$j - 1]) {
                    $dp[$i][$j] = $dp[$i - 1][$j - 1] + 1;
                } else {
                    $dp[$i][$j] = max($dp[$i - 1][$j], $dp[$i][$j - 1]);
                }
            }
        }

        $lcs = "";
        $i = $n;
        $j = $m;
        while ($i > 0 && $j > 0) {
            if ($X[$i - 1] === $Y[$j - 1]) {
                $lcs = $X[$i - 1] . $lcs;
                $i--;
                $j--;
            } elseif ($dp[$i - 1][$j] > $dp[$i][$j - 1]) {
                $i--;
            } else {
                $j--;
            }
        }

        return array($dp[$n][$m], $lcs);
    }

    /**
     * Muestra la tabla de programación dinámica.
     * @param string $X La primera cadena.
     * @param string $Y La segunda cadena.
     */
    function mostrar_tabla_dp($X, $Y) {
        $n = strlen($X);
        $m = strlen($Y);

        $dp = [];

        for ($i = 0; $i <= $n; $i++) {
            $dp[$i] = array_fill(0, $m + 1, 0);
        }   

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= $m; $j++) {
                if ($X[$i - 1] === $Y[$j - 1]) {
                    $dp[$i][$j] = $dp[$i - 1][$j - 1] + 1;
                } else {
                    $dp[$i][$j] = max($dp[$i - 1][$j], $dp[$i][$j - 1]);
                }
            }
        }

        echo "\nTabla de Programación Dinámica:\n";
        echo "          ";  
        printf("%4s", "ε");
        for ($j = 0; $j < $m; $j++) {
            printf("%4s", $Y[$j]);
        }   
        echo "\n";
        for ($i = 0; $i <= $n; $i++) {
            if ($i == 0) {
                printf("  %4s   ", "ε");
            } else {
                printf("  %4s   ", $X[$i - 1]);
            }   
            for ($j = 0; $j <= $m; $j++) {
                printf("  %4d   ", $dp[$i][$j]);
            }   
            echo "\n";
        }
    }

?>