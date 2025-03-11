<?php
require_once __DIR__ . '/../../conexion.php';

if (isset($_POST['guardar'])) {
    $emp_nombre = $_POST['emp_nombre'];
    $emp_apellido = $_POST['emp_apellido'];
    $emp_cargo = $_POST['emp_cargo'];
    $emp_email= $_POST['emp_email'];
    $emp_telefono = $_POST['emp_telefono'];
    $emp_contrasena = $_POST['emp_contrasena'];

    $cmd = $db->prepare("insert into empleados (emp_nombre,emp_apellido,emp_cargo,emp_email,emp_telefono,emp_contrasena)
        values ('$emp_nombre','$emp_apellido','$emp_cargo','$emp_email','$emp_telefono','$emp_contrasena')");

    $cmd->execute();

    if (!$cmd) {
        die('Error de consulta ');
    }
    echo "Se agrego satisfactoriamente";
}
