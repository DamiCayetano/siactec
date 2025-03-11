<?php

require_once __DIR__ . '/../../conexion.php';

    $id = $_POST['emp_id'];
    if (!empty($id)){
        $cmd = $db->prepare("delete from empleados where emp_id = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        
        echo "Tarea completada";
    }

 ?>