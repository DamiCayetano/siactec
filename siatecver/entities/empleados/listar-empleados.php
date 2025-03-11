<?php
require_once __DIR__ . '/../../conexion.php';

$cmd = $db->prepare("select * from empleados");
$cmd->execute();

if (!$cmd) {
    die('Error de consulta ');
}
$json = array();
if ($cmd->rowCount() > 0) {
    while ($registro = $cmd->fetch()) {
        $json[] = array(
            'emp_id' => $registro['emp_id'],
            'emp_nombre' => $registro['emp_nombre'],
            'emp_apellido' => $registro['emp_apellido'],
            'emp_cargo' => $registro['emp_cargo'],
        );
    }
    $json_string = json_encode($json);
    echo $json_string;
} else {
    $response = json_encode(["response" => "No se encontraron empleados"]);
    echo $response;
}
