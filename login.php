<?php
session_start();
require 'config/db.php';
require 'includes/funciones.php';
include 'includes/header.php'; // Incluye el header para mostrar SweetAlert

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $correo = $_POST["correo"] ?? '';
    $password_ingresada = $_POST["password"] ?? '';

    // 1. Buscar al usuario, SELECCIONANDO el campo 'nombre'
    // Asegúrate de incluir todas las columnas que necesitas para la sesión
    $stmt = $pdo->prepare("SELECT id_usuario, password, rol, nombre FROM USUARIOS WHERE usuario = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Verificar el usuario Y la contraseña hasheada
    if ($usuario && password_verify($password_ingresada, $usuario['password'])) { 
        
        // Contraseña correcta: Guardar los datos del usuario en la sesión
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['rol'] = $usuario['rol'];
        // 🚨 CAMBIO CLAVE: Guardamos el nombre recuperado de la DB
        $_SESSION['nombre'] = $usuario['nombre']; 

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
        // Usuario no encontrado o contraseña incorrecta
        echo "
        <script>
        Swal.fire({
            title: 'Usuario o contraseña incorrecta ☂️☂️☂️',
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
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div style="text-align: center;">
        <button type="submit" class="btn btn-outline-success btn-lg" >INGRESAR</button>
    </div>
    <div style="text-align: center; margin-top: 15px;">
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>

</form>

<?php
include 'includes/footer.php';
?>