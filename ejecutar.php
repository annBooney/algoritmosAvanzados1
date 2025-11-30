<?php
    ini_set('memory_limit', '512M');

    require_once __DIR__ . '/algoritmos/recursiva.php';
    require_once __DIR__ . '/algoritmos/hirschberg.php';
    require_once __DIR__ . '/algoritmos/dinamica.php';
    require_once __DIR__ . '/utils/funciones.php';

    echo "\n";
    echo "=================================================\n";
    echo "  ALGORITMOS LCS - SUBSECUENCIA COMÚN MÁS LARGA  \n";
    echo "=================================================\n\n";

    // ESección 1
    echo "\n";
    echo "=======================\n";
    echo "  EJEMPLO PASO A PASO  \n";
    echo "=======================\n\n";   

    $X = "ABCDGH";
    $Y = "AEDFHR";

    echo "\nCadenas de entrada:\n";
    echo "X: $X\n";
    echo "Y: $Y\n"; 

    $n = strlen($X);
    $m = strlen($Y);

    $dp = [];
    for ($i = 0; $i <= $n; $i++) {
        $dp[$i] = array_fill(0, $m + 1, 0);
    }

    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $m; $j++) {
            if($X[$i-1] == $Y[$j-1]){
                    $dp[$i][$j] = $dp[$i-1][$j-1] + 1  ;
            } else {
                    $dp[$i][$j] = max($dp[$i-1][$j], $dp[$i][$j-1]);
            }    
        }
    }

    echo "n\Tabla de Programación Dinámica:\n";
    echo "          ";

    printf("%4s", "e");
    for ($j = 0; $j < $m; $j++) {
        printf("%4s", $Y[$j]);
    }
    echo "\n";
    for ($i = 0; $i <= $n; $i++) {
        if ($i == 0) {
            printf("  %4s   ", "e");
        } else {
            printf("  %4s   ", $X[$i - 1]);
        }
        for ($j = 0; $j <= $m; $j++) {
            printf("  %4d   ", $dp[$i][$j]);
        }
        echo "\n";
    }

    echo "\nResultado: LCS = 'ADH', Longitud = 3\n";


    //Sección 2
    echo "\n";
    echo "=====================================\n";
    echo "  COMPARACIÓN DE LAS TRES VERSIONES  \n";
    echo "=====================================\n\n";

    $resultados_ejemplo = [];
    $res = medir_rendimiento('lcs_recursiva', $X, $Y, "Recursiva");
    $resultados_ejemplo[] = $res;
    $res = medir_rendimiento('lcs_hirschberg', $X, $Y, "Hirschberg");
    $resultados_ejemplo[] = $res;  
    $res = medir_rendimiento('lcs_dinamica', $X, $Y, "Programación Dinámica");
    $resultados_ejemplo[] = $res;   

    mostrar_tabla_resultados($resultados_ejemplo);

    //Sección 3
    echo "\n";
    echo "=================\n";
    echo "  COMPARACIONES    \n";
    echo "=================\n\n";

    $longitudes_prueba = [10, 50, 100, 200, 500, 1000];
    $resultados_comparacion = [];

    foreach ($longitudes_prueba as $longitud) {
        echo "\n --- Prueba con cadenas de longitud $longitud ---\n";
        $X_test = generar_cadena_aleatoria($longitud);
        $Y_test = generar_cadena_aleatoria($longitud);

        //Versión A Recursiva
        if($longitud <= 15){
            $res = medir_rendimiento('lcs_recursiva', $X_test, $Y_test, "Recursiva (n=$longitud)");
            $resultados_comparacion[] = $res;
            echo " Recursiva: LCS:{$res['longitud_lcs']}, Tiempo= ".number_format($res['tiempo_ms'], 2). "\n";
        } else {
            echo "Omitida versión Recursiva por alta complejidad.\n";
        }

        //Versión B Hirschberg
        $res = medir_rendimiento('lcs_hirschberg', $X_test, $Y_test, "Hirschberg (n=$longitud)");
        $resultados_comparacion[] = $res;
        echo " Hirschberg: LCS:{$res['longitud_lcs']}, Tiempo= ".number_format($res['tiempo_ms'], 2). "\n";
    
        //Versión C Programación Dinámica
        $res = medir_rendimiento('lcs_dinamica', $X_test, $Y_test, "Programación Dinámica (n=$longitud)");
        $resultados_comparacion[] = $res;
        echo " Programación Dinámica: LCS:{$res['longitud_lcs']}, Tiempo= ".number_format($res['tiempo_ms'], 2). "\n";  
    }

    //Sección 4
    echo "\n";
    echo "=========================\n";
    echo "  RESULTADOS COMPLETOS   \n";
    echo "=========================\n\n";

    mostrar_tabla_resultados($resultados_comparacion);

    //Sección 5
    echo "\n";
    echo "================\n";
    echo "  CONLUSIONES   \n";
    echo "================\n\n";

    mostrar_conclusiones();
    
    echo "\n";
    echo " *** Fin de la ejecución. ***\n";



    


?>