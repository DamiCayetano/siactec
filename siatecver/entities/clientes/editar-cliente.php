<?php

require_once '../../conexion.php';

if (isset($_POST['guardar'])) {
    $cli_id = $_POST['cli_id'];
    $cli_nombre = $_POST['cli_nombre'];
    $cli_apellido = $_POST['cli_apellido'];
    $cli_telefono = $_POST['cli_telefono'];

    $cmd = $db->prepare("UPDATE clientes
        SET 
            cli_nombre = ?,
            cli_apellido = ?,
            cli_telefono = ?
        WHERE cli_id = ?;");

    $cmd->execute([$cli_nombre,$cli_apellido,$cli_telefono,$cli_id]);

    if ($cmd->rowCount() > 0) {
        echo "Se actualizo satisfactoriamente";
    } else {
        echo "No se actualiza el cliente  ocurrio un error en la consulta";
    }
}