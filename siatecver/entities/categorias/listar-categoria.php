<?php
	require_once __DIR__ . '/../../conexion.php';

    $cmd = $db->prepare("select * from categorias");
    $cmd->execute();

    if(!$cmd){
    	die('Error de consulta ');
    }
    $json = array();
    if($cmd->rowCount() > 0){
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'id_categoria' => $registro['id_categoria'],
                'nombre_categoria' => $registro['nombre_categoria'],
                'descripcion' => $registro['descripcion']
            );
        }
        $json_string = json_encode($json);
        echo $json_string;

    }else{
        $response = json_encode(["response" => "No se encontraron usuarios"]);
        echo $response;
    }

?>