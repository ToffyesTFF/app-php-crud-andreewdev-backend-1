<?php

function obtenerCategoria($pdo)
{
    $stmt = $pdo->query("SELECT * FROM CATEGORIAS");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    

}

function obtenerMarca($pdo)
{
    $stmt = $pdo->query("SELECT * FROM MARCAS");    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

?>