<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>basico</title>
</head>
<body>
    <h1>PHP Básico</h1>
    <hr>
    <section>
        <h2>Variables</h2>
        <?php
            $nombre = " Andree Contreras😺🐼"; //PHP
            echo $nombre;
            echo "<br>Nombre:".$nombre;

            $edad = 30;
            echo "<br>Edad es : $edad xd";
            
            $profesor = true;
            echo "<br>Es profesor ".$profesor;

            $talla = 1.70;
            echo "<br>Edad es : $talla xd";
        ?>

        <h2>Constantes</h2>
        <?php
            define("PI",3.141516);
            echo "Valor de pi: ".PI ."<br>";
        ?>
    </section>
    <hr>
    <section>



    <?php
    date_default_timezone_set('America/Lima'); 

    $hora_actual = date("H:i");
    $hora_limite = date("13:15");
    //strtotime --> tiempo a numero
    
    if ($hora_actual > $hora_limite) {
        
        $mensaje = "¡ES HORA DE SALIDA! ╰(*°▽°*)╯";
        $color = "green";
        
    } else {
        
        $mensaje = "AÚN SIGUE LA CLASE... (ಥ_ಥ)";
        $color = "red";
    }
    ?>

    <h2>Control de Flujo</h2>

    <p>La hora actual es: <?php echo $hora_actual; ?></p>
    <div style="font-size: 2em; font-weight: bold; color: <?php echo $color; ?>;">
        <?php echo $mensaje; ?>
    </div>
        
    </section>

    

</body>
</html>