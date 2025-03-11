<?php
require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $cli_nombre = $_POST['cli_nombre'];
    $cli_apellido = $_POST['cli_apellido'];
    $cli_telefono = $_POST['cli_telefono'];

    $cmd = $db->prepare("insert into clientes (cli_nombre,cli_apellido,cli_telefono)
        values ('$cli_nombre','$cli_apellido','$cli_telefono')");

    $cmd->execute();

    if (!$cmd) {
        die('Error de consulta ');
    }
    echo "Se agrego satisfactoriamente";
}
