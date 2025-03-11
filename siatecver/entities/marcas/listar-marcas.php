<?php
	require_once __DIR__ . '/../../conexion.php';

    $cmd = $db->prepare("select * from marcas");
    $cmd->execute();

    if(!$cmd){
    	die('Error de consulta ');
    }
    $json = array();
    if($cmd->rowCount() > 0){
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'mar_id' => $registro['mar_id'],
                'mar_nombre' => $registro['mar_nombre'],
            );
        }
        $json_string = json_encode($json);
        echo $json_string;

    }else{
        $response = json_encode(["response" => "No se encontraron marcas"]);
        echo $response;
    }

?>