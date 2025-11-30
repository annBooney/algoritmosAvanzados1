# Algoritmos Avanzados
Actividad 1. Diseño, análisis y comparación de algoritmos
Implementación y comparación de tres algoritmos para calcular la subsecuencia conmún más larga o LCS.

Estructura del proyecto
------------------------
algoritmosAvanzados1/
├── README.md                    # Este archivo
├── ejecutar.php                 # Archivo principal
├── algoritmos/
│   ├── recursiva.php            # Versión A: Recursiva
│   ├── hirschberg.php           # Versión B: Divide y Vencerás
│   └── dinamica.php             # Versión C: Programación Dinámica
└── utils/
    └── funciones.php            # Funciones auxiliares

Requisitos
-----------
PHP 7.4 o superior. Recomendado PHP 8.X.

Ejecución
----------
En la consola, dentro del directorio, ejecutar php ejecutar.php

Salida
-------
El programa muestra:
    1. Ejemplo paso a paso con la tabla DP visualizada.
    2. Comparación de las tres versiones con el mismo input.
    3. Experimentos con cadenas de diferentes tamaños de 10 a 1000 caracteres.
    4. Tabla de resultados con tiempos y uso de memoria.
    5. Conclusiones del análisis.


