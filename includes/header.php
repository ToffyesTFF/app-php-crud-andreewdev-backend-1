<?php

// Verifica si la sesión no ha sido iniciada y la inicia
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP|🎀Andree Contreras🐼</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">CRUD PHP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <?php if(!empty($_SESSION['id_usuario'])): ?>
                    
                    <li class="nav-item">
                        <?php if ($_SESSION['rol'] == 'owner' || $_SESSION['rol'] == 'admin'): ?>
                        <a class="nav-link active" aria-current="page" href="index.php">Productos</a>
                        <?php endif; ?>
                    </li>
            
                    <li class="nav-item">
                        <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a class="nav-link" href="#">Categorias</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a class="nav-link" href="#">Marcas</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($_SESSION['rol'] == 'owner' || $_SESSION['rol'] == 'admin'): ?>
                        <a class="nav-link" href="#">Reportes admin</a>
                        <?php else: ?>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Reportes 1</a>
                        <?php endif; ?>
                    </li>
                <?php endif;  ?>
                </ul>
            </div>

            <div>
                <ul class="navbar-nav">
                    <li>
                        <div class="pe-2">
                            <?php if(!empty($_SESSION['id_usuario'])): ?>
                            <p class="p-0 m-0 small"><?= isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario'?></p>
                            <small>rol: <?= htmlspecialchars($_SESSION['rol'])?></small>
                            <?php endif ?>
                        </div>
                    </li>
                    <li>
                        <?php if(!empty($_SESSION['id_usuario'])):?>
                        <a class="nav-link" href="logout.php">Cerrar session</a>
                        <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <?php endif ?>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="container py-4">