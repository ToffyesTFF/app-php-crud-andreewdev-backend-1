<?php
session_start();
// Incluir la conexión a la base de datos
require 'config/db.php';
require 'includes/funciones.php'; 
include 'includes/header.php';

// --- PROCESAMIENTO DEL FORMULARIO DE REGISTRO ---
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // 1. Obtener los datos
    $correo = $_POST["correo"] ?? '';
    $password = $_POST["password"] ?? ''; 
    // Usamos 'empleado' como rol por defecto, basándonos en tu ejemplo
    $rol_default = 'usuario nuevo'; 

    // 2. Validar campos obligatorios
    if (empty($correo) || empty($password)) {
        echo "<script>
            Swal.fire({
                title: 'Error de registro',
                text: 'Todos los campos son obligatorios.', 
                icon: 'warning'
            });
        </script>";
    } else {
        
        // 3. Verificar si el usuario/correo ya existe
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
            // 4. Insertar el nuevo usuario
            // Insertamos solo en las columnas 'usuario', 'password', y 'rol'
            $stmt_insert = $pdo->prepare("INSERT INTO USUARIOS (usuario, password, rol) VALUES (?, ?, ?)");
            
            // Los valores pasados son: correo (para 'usuario'), password, y el rol por defecto
            $resultado = $stmt_insert->execute([$correo, $password, $rol_default]);

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