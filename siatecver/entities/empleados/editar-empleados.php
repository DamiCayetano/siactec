<?php

require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $emp_id = $_POST['emp_id'];
    $emp_nombre =$_POST['emp_nombre'];
    $emp_apellido = $_POST['emp_apellido'];
    $emp_cargo = $_POST['emp_cargo'];
    $emp_email = $_POST['emp_email'];
    $emp_telefono = $_POST['emp_telefono'];
    $emp_contrasena= $_POST['emp_contrasena'];

    $cmd = $db->prepare("UPDATE empleados
        SET
            emp_nombre = ?,
            emp_apellido = ?,
            emp_cargo = ?,
            emp_email = ?,
            emp_telefono = ?,
            emp_contrasena = ?
        WHERE emp_id = ?;");


    $cmd->execute([$emp_nombre,$emp_apellido,$emp_cargo,$emp_email,$emp_telefono,$emp_contrasena,$emp_id]);

    if ($cmd->rowCount() > 0) {
        echo "Se actualizo satisfactoriamente";
    } else {
        echo "No se actualiza el empleado  ocurrio un error en la consulta";
    }
}
