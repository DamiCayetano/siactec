<?php

    require_once '../../conexion.php';

    $id = $_POST['id'];
    
    if (!empty($id)){
        $cmd = $db->prepare("select * from clientes where cli_id = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'cli_id' => $registro['cli_id'],
                'cli_nombre' => $registro['cli_nombre'],
                'cli_apellido' => $registro['cli_apellido'],
                'cli_telefono' => $registro['cli_telefono'],
            ];
        }
        $json_string = json_encode($json);
        echo $json_string;
    }

?>