<?php

require_once __DIR__ . '/../../conexion.php';

    $id = $_POST['id'];

    if (!empty($id)){
        $cmd = $db->prepare("select * from empleados where emp_id = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'emp_id' => $registro['emp_id'],
                'emp_nombre' => $registro['emp_nombre'],
                'emp_apellido' => $registro['emp_apellido'],
                'emp_cargo' => $registro['emp_cargo'],
                'emp_email' => $registro['emp_email'],
                'emp_telefono' => $registro['emp_telefono'],
                'emp_contrasena' => $registro['emp_contrasena']
            ];
        }
        $json_string = json_encode($json);
        echo $json_string;
    }

 ?>