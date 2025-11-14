<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Básico (Ejemplos Simples)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            border-bottom: 3px solid #007bff;
            padding-bottom: 5px;
        }

        h2 {
            color: #555;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
            margin-top: 30px;
        }

        .code-output {
            background-color: #eef;
            padding: 10px;
            margin: 5px 0;
            border-left: 4px solid #007bff;
            font-family: monospace;
            white-space: pre-wrap;
        }

        .console-output {
            background-color: #080749ff;
            color: #ffffffff;
            padding: 15px;
            font-family: monospace;
            white-space: pre-wrap;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>PHP Básico - Ejemplos Clave</h1>
        <hr>

        <section>
            <h2>1. Variables y Constantes</h2>
            <div class="code-output">
                <?php
                $nombre = "Andree Contreras 😺🐼"; // String
                echo "<strong>\$nombre:</strong> " . $nombre;
                echo "<br>";

                $edad = 30; // Integer
                echo "<strong>\$edad:</strong> $edad xd";
                echo "<br>";

                $profesor = true; // Boolean
                echo "<strong>\$profesor (Boolean):</strong> " . ($profesor ? 'true (1)' : 'false (0)');
                echo "<br>";

                $talla = 1.70; // Float
                echo "<strong>\$talla (Float):</strong> $talla m";
                ?>
            </div>

            <h3>Constantes</h3>
            <div class="code-output" style="border-left: 4px solid #28a745;">
                <?php
                define("PI", 3.14159);
                echo "<strong>Constante PI:</strong> " . PI;
                ?>
            </div>
        </section>
        <hr>

        <section>
            <h2>2. Control de Flujo: Ejemplo de Horario</h2>

            <?php
            date_default_timezone_set('America/Lima');

            $hora_actual_string = date("H:i");
            $hora_limite_string = date("13:15");

            $hora_actual_dt = new DateTime($hora_actual_string);
            $hora_limite_dt = new DateTime($hora_limite_string);

            if ($hora_actual_dt > $hora_limite_dt) {
                $mensaje = "¡ES HORA DE SALIDA! ╰(*°▽°*)╯";
                $color = "green";
            } else {
                $mensaje = "AÚN SIGUE LA CLASE... (ಥ_ಥ)";
                $color = "black";
            }
            ?>

            <p>La hora actual es: <strong><?php echo $hora_actual_string; ?></strong> (Límite: <?php echo $hora_limite_string; ?>)</p>
            <div style="font-size: 1.5em; font-weight: bold; padding: 10px; border: 2px solid <?php echo $color; ?>; color: <?php echo $color; ?>; border-radius: 4px; text-align: center;">
                <?php echo $mensaje; ?>
            </div>
        </section>

        <hr>

        <section>
            <h2>3. Operadores, Bucles, Funciones y Arreglos</h2>
            <div class="console-output">
                <?php
                // Esto simula una salida de consola para ver los resultados de cada bloque de código.

                // =========================================================
                // OPERADORES
                // =========================================================
                echo "--- OPERADORES ---\n";

                $edad = 25;
                $tiene_licencia = true;
                if ($edad >= 18 && $tiene_licencia) {
                    echo "Lógico (AND): Puede conducir. \n";
                }

                $a = 10;
                $a = $a + 5;
                $a += 5;
                echo "Asignación (+=): Valor de \$a: " . $a . "\n";

                $num1 = 15;
                $resto = $num1 % 4;
                echo "Aritmético (%): Resto de 15/4: " . $resto . "\n";

                $contador_inc = 5;
                echo "Incremento (++\$): Pre-incremento (++5): " . ++$contador_inc . "\n\n";

                $contador_inc = 5;
                echo "Decremento (--\$): Pre-incremento (--5): " . --$contador_inc . "\n\n";

                // =========================================================
                // CONTROL DE FLUJO Y BUCLES
                // =========================================================
                echo "--- BUCLES Y FLUJO ---\n";

                // IF - ELSEIF - ELSE
                $puntaje = 65;
                if ($puntaje >= 70) {
                    echo "IF: Aprobado. \n";
                } elseif ($puntaje == 65) {
                    echo "elseif:casi apruebas mijo\n";
                } else {
                    echo "ELSE: Reprobado. \n"; 
                }

                switch ($puntaje) {
                    case 60:
                        echo "SWITCH: puntaje igual a 60\n";
                        break; 
                    case 65:
                        echo "SWITCH: puntaje igual a 65\n";
                        
                    case 70:
                        echo "SWITCH: puntaje igual a 70\n";
                        break;
                    default:
                        echo "SWITCH: puntaje diferente de 60, 65 o 70\n";
                        break;
                }

                // FOR
                echo "FOR: ";
                for ($i = 1; $i <= 3; $i++) {
                    echo "[$i] ";
                }
                echo "\n";


                $contador = 1; 

                while ($contador <= 10) { 
                    echo "El número es: " . $contador . "\n"; 
                    $contador++; 
                }


                // FOR-EACH (para arrays)
                $colores = ["Rojo", "Verde", "Azul"];
                echo "FOR-EACH: ";
                foreach ($colores as $color) {
                    echo "$color ";
                }
                echo "\n\n";

                // =========================================================
                // FUNCIONES
                // =========================================================
                echo "--- FUNCIONES ---\n";

                // Función con Parámetros y salida
                function saludar($nombre)
                {
                    echo "Función: Hola, " . $nombre . ", bienvenido. \n";
                }
                saludar("Andree");

                // Función con Retorno
                function calcularAreaCuadrado($lado)
                {
                    return $lado * $lado;
                }
                $area = calcularAreaCuadrado(5);
                echo "Función con Retorno: El área de lado 5 es: " . $area . "\n\n";

                // =========================================================
                // ARREGLOS
                // =========================================================
                echo "--- ARREGLOS ---\n";

                // Arreglo Indexado (con indice)
                $peliculas = array("Matrix", "Inception");
                echo "Indexado: Primera película: " . $peliculas[1] . "\n";

                // Arreglo Asociativo
                $persona = ["nombre" => "Carlos", "edad" => 30];
                echo "Asociativo: " . $persona["nombre"] . " tiene " . $persona["edad"] . " años. \n";

                echo "---------------------------------\n";
                ?>
            </div>
        </section>

        <footer style="text-align: center; color: #999; padding-top: 20px; border-top: 1px solid #eee; margin-top: 40px;">
        </footer>
    </div>
</body>

</html>