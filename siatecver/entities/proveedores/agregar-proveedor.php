<?php
require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $razon_social = $_POST['razon_social'];
    $sector_comercial = $_POST['sector_comercial'];
    $tipo_documento = $_POST['tipo_documento'];
    $num_documento = $_POST['num_documento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $url = $_POST['url'];

    $cmd = $db->prepare("insert into proveedores (prov_razon_social,prov_sector_comercial, prov_tipo_documento,prov_num_documento,prov_direccion,prov_telefono, prov_email, prov_url, prov_fecha_creacion)
        values ('$razon_social','$sector_comercial','$tipo_documento','$num_documento','$direccion','$telefono','$email','$url','2025-03-04 10:01:03')");

    $cmd->execute();

    if (!$cmd) {
        die('Error de consulta ');
    }
    echo "Se agrego satisfactoriamente";
}
