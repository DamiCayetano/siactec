<?php

require_once '../../conexion.php';

if (isset($_POST['guardar'])) {
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];

    $cmd = $db->prepare("UPDATE categorias
        SET 
            nombre_categoria = ?,
            descripcion = ?

        WHERE id_categoria = ?;");

    $cmd->execute([$nombre_categoria,$descripcion,$id_categoria]);

    if ($cmd->rowCount() > 0) {
        echo "Se actualizo satisfactoriamente";
    } else {
        echo "No se actualiza la categoria  ocurrio un error en la consulta";
    }
}