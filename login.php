<?php
session_start();
require 'config/db.php';
require 'includes/funciones.php';
include 'includes/header.php';



if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    //var_dump($correo, $password);
    $stmt = $pdo->prepare("SELECT * FROM USUARIOS WHERE usuario = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $password == $usuario['password']) {

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = 'Andree Contreras';
        $_ROL['rol'] = $usuario['rol'];


        echo "
        <script>
        Swal.fire({
            title: ' Ingreso exitoso ',
            text: '🐼🐼🐼 🎀🎀🎀',
            icon: 'success'
        }).then(()=>window.location='index.php');
        </script>
        ";

    } else {
        echo "
        <script>
        Swal.fire({
            title: 'Usuario o contraseña incorrecta ☂️☂️☂️',
            // Usa el mensaje de error escapado
            text: 'Vuelve a intentarlo', 
            icon: 'error'
        }).then(() => window.location='login.php');
        </script>
        ";
    }
}

?>


<h2 style="text-align: center;">🐼 LOGIN 🎀</h2>
<br>

<form method="POST">
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div style="text-align: center;">

        <button type="submit" class="btn btn-outline-success btn-lg" >INGRESAR</button>
    </div>
    
</form>



<?php
include 'includes/footer.php';
?>