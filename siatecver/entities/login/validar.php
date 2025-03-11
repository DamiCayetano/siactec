<?php

require_once '../../conexion.php';

$correo = $_POST['emp_correo'];
$contrasena = $_POST['emp_contrasena'];

if (!empty($correo) && !empty($contrasena)) {
    $cmd = $db->prepare("SELECT * FROM empleados WHERE emp_email = ? AND emp_contrasena = ?");
    
    $cmd->execute([$correo, $contrasena]);

    if ($cmd->rowCount() > 0) {
        $json_string = json_encode(["response" => "Usuario autenticado"]);
    } else {
        $json_string = json_encode(["response" => "Usuario no se encuentra autenticado"]);
    }
    echo $json_string;
} else {
    echo json_encode(["response" => "Correo y contraseña son requeridos"]);
}
?>
