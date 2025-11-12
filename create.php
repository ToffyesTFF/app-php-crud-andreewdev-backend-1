<?php
require 'config/db.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
     ///Los espacios tambien cuentan como caracteres XD
    $nombre = $_POST["nombre"];//trabaja con el "name"
    $descripcion = $_POST["descripcion"];
    $precio =$_POST["precio"];
    $stock = $_POST["stock"];
    //echo 
    //var_dump y die, dd
    //var_dump($nombre,$precio,$descripcion,$stock);
    $stmt = $pdo->prepare("INSERT INTO PRODUCTOS (nombre, descripcion, precio, stock) 
    VALUES (?,?,?,?)
    ");
    $stmt->execute([$nombre,$descripcion,$precio,$stock]);

    header("Location:index.php");
    exit;
}




?>

<h2>Agregar nuevo producto 🎀➕</h2>
<br>

<form method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
    </div>
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio">
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock">
    </div>
    <button type="submit" class="btn btn-outline-info">GUARDAR</button>
</form>




<h2>Sube tu Imagen</h2>

<form action="create.php" method="POST" enctype="multipart/form-data">

    <label for="imagen">Selecciona una imagen:</label>
    <input type="file" name="archivo" id="imagen" required>

    <button type="submit">Subir y Mostrar</button>
</form>


<?php

$target_dir = "img/";

$target_file = $target_dir . basename($_FILES["archivo"]["name"]);

if (!isset($_FILES["archivo"])) {
    die("Error: No se ha seleccionado ningún archivo.");
}

if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
    
    echo "<h1>¡Imagen subida correctamente!</h1>";
    
    echo "<img src='$target_file' alt='Imagen Subida' style='max-width: 500px; height: auto;'>";
    
    echo "<p>Ruta en el servidor: " . $target_file . "</p>";
    
} else {
    echo "<h1>Lo sentimos, hubo un error al subir tu archivo.</h1>";
    echo "<p>Revisa que la carpeta 'uploads' exista y tenga permisos de escritura.</p>";
}

?>



<?php
include 'includes/footer.php';
?>