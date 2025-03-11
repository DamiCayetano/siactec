<?php
require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $mar_nombre = $_POST['mar_nombre'];

    $cmd = $db->prepare("insert into marcas (mar_nombre)
        values ('$mar_nombre')");

    $cmd->execute();

    if (!$cmd) {
        die('Error de consulta ');
    }
    echo "Se agrego satisfactoriamente";
}
