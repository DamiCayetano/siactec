<?php

    include '../../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from clientes where cli_nombre like '$buscar%'");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        $json = array();
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'cli_nombre' => $registro['cli_nombre'],
                'cli_id' => $registro['cli_id']
            );
		}

        $json_string = json_encode($json);
        echo $json_string;
    }

    ?>