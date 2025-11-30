<?php
function generar_cadena_aleatoria($longitud, $alfabeto="ACGT") {
    $cadena = '';
    $maximo = strlen($alfabeto) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $cadena .= $alfabeto[rand(0, $maximo)];
    }
    return $cadena;
}

function medir_rendimiento($funcion, $x, $y, $nombre){
    gc_collect_cycles(); // Limpiar ciclos de recolección de basura
    $memoria_inicial = memory_get_usage(true);
    $tiempo_inicial = microtime(true);

    try {
        list($longitud, $lcs) = $funcion($x, $y);
    } catch (Exception $e) {
        $longitud = -1;
        $lcs = substr($e->getMessage(), 0, 50);
        $exito = false;
    }

    $fin = microtime(true);
    $memoria_pico = memory_get_peak_usage(true);
    $tiempo_ms = ($fin - $tiempo_inicial) * 1000;
    $memoria_usada = $memoria_pico - $memoria_inicial;

    return array(
        'nombre'        => $nombre,
        'longitud'      => $longitud,
        'lcs'           => $lcs,
        'tiempo_ms'     => $tiempo_ms,
        'memoria_usada' => $memoria_usada,
        'memoria_mb'    => $memoria_usada / (1024 * 1024),
        'exito'         => $exito,
        "lcs_preview"  => strlen($lcs) > 50 ? substr($lcs, 0, 50) . "..." : $lcs
    );
}



function mostrar_tabla_resultados($resultados) {
    echo "\n";
    echo "+----------------------+-------------+----------------+------------+------------+-------+\n";
    echo "| Algoritmo            | Longitud    | Preview LCS    | Tiempo(ms) | Memoria(MB)| Exito |\n";
    echo "+----------------------+-------------+----------------+------------+------------+-------+\n";
    
    foreach ($resultados as $r) {
        $nombre = str_pad(substr($r['nombre'], 0, 20), 20);
        $longitud = str_pad($r['lcs'], 11);
        $preview = str_pad(substr($r['lcs_preview'], 0, 14), 14);
        $tiempo = str_pad(number_format($r['tiempo_ms'], 2), 10);
        $memoria = str_pad(number_format($r['memoria_mb'], 4), 10);
        $exito = $r['exito'] ? "Si   " : "No   ";
        
        echo "| $nombre | $longitud | $preview | $tiempo | $memoria | $exito |\n";
    }
    
    echo "+----------------------+-------------+----------------+------------+------------+-------+\n";
}


function mostrar_conclusiones() {
    echo "\n";
    echo "====================\n";
    echo "  CONCLUSIONES\n";
    echo "====================\n";
    echo "\n";
    echo "VERSIÓN A - RECURSIVA DIRECTA\n";
    echo "  - Complejidad temporal: O(2^(n+m)) - Exponencial.\n";
    echo "  - Complejidad espacial: O(n+m) - Pila de recursion.\n";
    echo "  - Util solo para cadenas muy cortas o propositos educativos.\n";
    echo "  - Util para entender el concepto.\n";
    echo "\n";
    echo "VERSIÓN B - HIRSCHBERG - DIVIDE Y VENCERAS\n";
    echo "  - Complejidad temporal: O(n*m).\n";
    echo "  - Complejidad espacial: O(min(n,m)) - Uso eficiente de memoria.\n";
    echo "  - Mejor opcion cuando la memoria es limitada.\n";
    echo "  - Escala bien para cadenas muy largas.\n";
    echo "\n";
    echo "VERSIÓN C - PROGRAMACION DINAMICA TABULAR\n";
    echo "  - Complejidad temporal: O(n*m).\n";
    echo "  - Complejidad espacial: O(n*m) - Matriz completa.\n";
    echo "  - Facil de implementar y entender.\n";
    echo "  - Requiere mas memoria, puede ser ineficiente para cadenas muy largas.\n";
    echo "  - Mas rapida en practica por mejor uso de cache.\n";
    echo "\n";
}



?>