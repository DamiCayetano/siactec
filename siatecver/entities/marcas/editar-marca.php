<?php

require_once '../../conexion.php';

if (isset($_POST['guardar'])) {
    $mar_id = $_POST['mar_id'];
    $mar_nombre = $_POST['mar_nombre'];

    $cmd = $db->prepare("UPDATE marcas
        SET 
            mar_nombre = ?
        WHERE mar_id = ?;");

    $cmd->execute([$mar_nombre,$mar_id]);

    if ($cmd->rowCount() > 0) {
        echo "Se actualizo satisfactoriamente";
    } else {
        echo "No se actualiza la marca  ocurrio un error en la consulta";
    }
}