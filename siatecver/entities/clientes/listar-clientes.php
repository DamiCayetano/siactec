<?php
	require_once __DIR__ . '/../../conexion.php';

    $cmd = $db->prepare("select * from clientes");
    $cmd->execute();

    if(!$cmd){
    	die('Error de consulta ');
    }
    $json = array();
    if($cmd->rowCount() > 0){
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'cli_id' => $registro['cli_id'],
                'cli_nombre' => $registro['cli_nombre'],
                'cli_apellido' => $registro['cli_apellido'],
                'cli_telefono' => $registro['cli_telefono'],
            );
        }
        $json_string = json_encode($json);
        echo $json_string;

    }else{
        $response = json_encode(["response" => "No se encontraron clientes"]);
        echo $response;
    }

?>