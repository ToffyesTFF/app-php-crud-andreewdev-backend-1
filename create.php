<?php

require 'config/db.php';
require 'includes/funciones.php';
include 'includes/header.php';

$creado_por_id = $_SESSION['id_usuario']; 
$categorias = obtenerCategoria($pdo);
$marcas= obtenerMarca($pdo);


if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    
    $nombre = $_POST["nombre"]; 
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $categoria = $_POST["id_categoria"];
    $marca = $_POST["id_marca"];
    
    

    try {
        $stmt = $pdo->prepare("INSERT INTO PRODUCTOS (nombre, descripcion, precio, stock, id_categoria, id_marca, creado_por) 
        VALUES (?,?,?,?,?,?,?)");

       $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria, $marca, $creado_por_id]);

        echo "
        <script>
        Swal.fire({
            title: 'Producto guardado',
            text: 'Producto registrado correctamente',
            icon: 'success'
        }).then(()=>window.location='index.php');
        </script>

        ";
    } catch (PDOException $e) {
        $error = addslashes($e->getMessage());
        echo "
        <script>
        Swal.fire({
            title: 'Error al guardar',
            text: '$error',
            icon: 'error'
        }).then(()=>window.location='create.php');
        </script>
        
        ";
    }
    
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
        <input type="number" class="form-control" id="precio" name="precio" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock">
    </div>
    <div class="mb-3">
        <label  for="categoria">Categoria</label>
        <select name="id_categoria" class="form-select  " aria-label="Default select example">
            <option selected>Seleccione una categoria</option>
            <?php foreach ($categorias as $item):?>
            <option value="<?= $item["id_categoria"]; ?>" >
                <?= $item["nombre"]; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label  for="marca">Marca</label>
        <select name="id_marca" class="form-select  " aria-label="Default select example">
            <option selected>Seleccione una marca</option>
            <?php foreach ($marcas as $item):?>
            <option value="<?= $item["id_marca"]; ?>">
                <?= $item["nombre"]; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    
    

    <button type="submit" class="btn btn-outline-info">GUARDAR</button>
</form>


<?php
include 'includes/footer.php';
?>