<?php
require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];

    $cmd = $db->prepare("insert into categorias (nombre_categoria,descripcion)
        values ('$nombre_categoria','$descripcion')");

    $cmd->execute();

    if (!$cmd) {
        die('Error de consulta ');
    }
    echo "Se agrego satisfactoriamente";
}
