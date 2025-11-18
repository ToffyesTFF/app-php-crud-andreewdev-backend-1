<?php
session_start();
require 'config/db.php';
require 'includes/funciones.php'; 
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $correo = $_POST["correo"] ?? '';
    $password_plano = $_POST["password"] ?? '';
    $rol_default = 'usuario'; 
    $nombre_ = $_POST["nombre"] ?? '';

    if (empty($correo) || empty($password_plano)) {
        echo "<script>
            Swal.fire({
                title: 'Error de registro',
                text: 'Todos los campos son obligatorios.', 
                icon: 'warning'
            });
        </script>";
    } else {
        
        $password_hashed = password_hash($password_plano, PASSWORD_DEFAULT); 

        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM USUARIOS WHERE usuario = ?");
        $stmt_check->execute([$correo]);
        $existe = $stmt_check->fetchColumn();

        if ($existe > 0) {
            echo "<script>
                Swal.fire({
                    title: 'Usuario existente',
                    text: 'El correo ya está registrado.', 
                    icon: 'info'
                }).then(() => window.location='register.php');
            </script>";
        } else {
            $stmt_insert = $pdo->prepare("INSERT INTO USUARIOS (usuario, password, rol, nombre) VALUES (?, ?, ?, ?)");
            
            $resultado = $stmt_insert->execute([$correo, $password_hashed, $rol_default, $nombre_]);

            if ($resultado) {
                echo "<script>
                    Swal.fire({
                        title: '¡Registro Exitoso!',
                        text: 'Ahora puedes iniciar sesión.',
                        icon: 'success'
                    }).then(() => window.location='login.php');
                </script>";
            } else {
                 echo "<script>
                    Swal.fire({
                        title: 'Error en la base de datos',
                        text: 'Hubo un error al intentar guardar el usuario.', 
                        icon: 'error'
                    });
                </script>";
            }
        }
    }
}
?>

<h2 style="text-align: center;">📝 REGISTRO DE USUARIO 🎀</h2>
<br>

<form method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div style="text-align: center;">
        <button type="submit" class="btn btn-outline-primary btn-lg">REGISTRARSE</button>
    </div>
    <div style="text-align: center; margin-top: 15px;">
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia Sesión aquí</a></p>
    </div>
</form>

<?php
include 'includes/footer.php';
?>