<?php
require 'config/db.php';
require 'includes/funciones.php';
include 'includes/header.php';


$stmt = $pdo->query("SELECT
                p.id_producto,
                p.nombre,
                p.descripcion,
                c.nombre AS categoria,   
                m.nombre AS marca,     
                p.precio,
                p.stock
            FROM
                productos p
            INNER JOIN
                categorias c ON p.id_categoria = c.id_categoria
            INNER JOIN
                marcas m ON p.id_marca = m.id_marca
            ORDER BY
                p.id_producto ASC
");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categorias = obtenerCategoria($pdo);
$marcas = obtenerMarca($pdo);

// var_dump($categorias, $marcas);

?>

<h2>Gestión de Productos</h2>
<hr>

<a href="create.php" type="button" class="btn btn-outline-info">🎀 NUEVO PRODUCTO ➕</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Categoria</th>
            <th scope="col">Marca</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($productos as $item): ?>
            <tr>
                <th scope="row"><?= $item["id_producto"] ?></th>
                <td><?= $item["nombre"] ?></td>
                <td><?= $item["descripcion"] ?></td>
                <td><?= $item["categoria"] ?></td>
                <td><?= $item["marca"] ?></td>
                <td><?= $item["precio"] ?></td>
                <td><?= $item["stock"]  ?></td>
                <td>
                    <div style="display: flex">
                        <!-- Los enlaces a update y delete necesitan el ID del producto -->
                        <a href="update.php?id_producto=<?= $item["id_producto"]  ?>" type="button" class="mx-2 btn btn-success">☂️</a>
                        <a href="delete.php?id_producto=<?= $item["id_producto"]  ?>" type="button" class="mx-2 btn btn-danger">🗑️</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<!-- <script>
// El script de SweetAlert2 se mantiene comentado
// Swal.fire({
//     title: "¡ewewewew!",
//     text: "Producto registrado correctamente",
//     icon: "success"
// }).then(()=>window.location='index.php');
// </script> -->

<?php
include 'includes/footer.php';
?>