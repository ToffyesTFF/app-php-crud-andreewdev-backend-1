
<?php
require 'config/db.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM categorias");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo $productos;
?>

<h1>Hola Mundo</h1>
<img src="img/4.webp" alt="10px">

<?php
include 'includes/footer.php'

?>