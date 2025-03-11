<?php

    include '../../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from empleados where emp_nombre like '$buscar%'");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        $json = array();
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'emp_nombre' => $registro['emp_nombre'],
                'emp_id' => $registro['emp_id']
            );
		}

        $json_string = json_encode($json);
        echo $json_string;
    }

    ?>