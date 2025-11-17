<?php
require 'config/db.php';
require 'includes/funciones.php';
include 'includes/header.php';

$id_producto = $_GET['id_producto'];
$stmt = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE ID_PRODUCTO = ?");
$stmt->execute([$id_producto]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

$categorias = obtenerCategoria($pdo);
$marcas= obtenerMarca($pdo);


if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    ///Los espacios tambien cuentan como caracteres XD
    $nombre = $_POST["nombre"]; //trabaja con el "name"
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $categoria = $_POST["id_categoria"]; 
    $marca = $_POST["id_marca"];

    try {
        $stmt = $pdo->prepare("UPDATE PRODUCTOS 
        SET nombre = ?, descripcion = ?, precio = ?, stock= ? , id_categoria =?, id_marca=?
        WHERE id_producto = ?
        ");

        $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria, $marca, $id_producto]);

        echo "
        <script>
        Swal.fire({
            title: '☂️Producto editado 🎀',
            text: 'Producto editado correctamente',
            icon: 'success'
        }).then(()=>window.location='index.php');
        </script>

        ";

    } catch (PDOException $e) {
        $error = addslashes($e->getMessage());
        echo "
        <script>
        Swal.fire({
            title: 'Error al editar',
            text: '$error',
            icon: 'error'
        }).then(()=>window.location='create.php');
        </script>
        
        ";

    }



    exit;
}




?>

<h2>Actualizar producto ☂️🎀</h2>
<br>

<form method="POST">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre"
        value="<?= $producto['nombre'] ?>"> 
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion"
        value="<?= $producto['descripcion'] ?>"> 
    </div>
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" required 
        value="<?= $producto['precio'] ?>"> 
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock"
        value="<?= $producto['stock'] ?>"> 
    </div>
    <div class="mb-3">
        <label for="id_categoria">Categoria</label>
        <select name="id_categoria" id="id_categoria" class="form-select" aria-label="Seleccione una categoria" required>
            <option value="null" disabled>Seleccione una categoria</option>
            <?php foreach ($categorias as $item): 
                $selected = (int)($producto['id_categoria'] ?? 0) === (int)$item["id_categoria"] ? 'selected' : '';
            ?>
            <option value="<?= htmlspecialchars($item["id_categoria"]); ?>" <?= $selected ?>>
                <?= htmlspecialchars($item["nombre"]); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_marca">Marca</label>
        <select name="id_marca" id="id_marca" class="form-select" aria-label="Seleccione una marca" required>
            <option value="null" disabled>Seleccione una marca</option>
            <?php foreach ($marcas as $item): 
                $selected = (int)($producto['id_marca'] ?? 0) === (int)$item["id_marca"] ? 'selected' : '';
            ?>
            <option value="<?= htmlspecialchars($item["id_marca"]); ?>" <?= $selected ?>>
                <?= htmlspecialchars($item["nombre"]); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>




    <button type="submit" class="btn btn-outline-info">GUARDAR</button>

</form>

<img src="img/4.webp" alt="">

<?php
include 'includes/footer.php';
?>