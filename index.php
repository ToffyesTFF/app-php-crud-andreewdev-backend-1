<?php
require 'config/db.php';
include 'includes/header.php';

try {
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error al consultar productos: " . $e->getMessage();
    $productos = [];
    //var_dump alt shif F
}
?>

<h2>Gestión de Productos</h2>
<hr>

<a href="create.php" type="button" class="btn btn-outline-info">🎀➕ NUEVO PRODUCTO</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($productos as $item): ?>
        <tr>
            <th scope="row"><?= $item["id_producto"]; ?></th>
            <td><?= $item["nombre"]; ?></td>
            <td><?= $item["descripcion"]; ?></td>
            <td><?= $item["precio"]; ?></td>
            <td><?= $item["stock"]; ?></td>
            <td >
                <div style="display: flex">
                    <a href="" type="button" class="mx-2 btn btn-outline-success">☂️</a>
                    <a href="delete.php?id_producto=<?= $item["id_producto"]; ?>" type="button" class="mx-2 btn btn-outline-danger">🗑️</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
?>