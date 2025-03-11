<?php

require_once '../../conexion.php';

if (isset($_POST['guardar'])) {
    $prov_id = $_POST['id'];
    $razon_social = $_POST['razon_social'];
    $sector_comercial = $_POST['sector_comercial'];
    $tipo_documento = $_POST['tipo_documento'];
    $num_documento = $_POST['num_documento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $url = $_POST['url'];

    $cmd = $db->prepare("UPDATE proveedores
        SET 
            prov_razon_social = ?,
            prov_sector_comercial = ?,
            prov_tipo_documento	= ?,
            prov_num_documento = ?,
            prov_direccion = ?,
            prov_telefono = ?,
            prov_email = ?,
            prov_url = ?
        WHERE prov_id = ?;");

    $cmd->execute([$razon_social,$sector_comercial,$tipo_documento,$num_documento,$direccion,$telefono,$email,$url,$prov_id]);

    if ($cmd->rowCount() > 0) {
        echo "Se actualizo satisfactoriamente";
    } else {
        echo "No se actualiza el usuario  ocurrio un error en la consulta";
    }
}
