<?php
	require_once __DIR__ . '/../../conexion.php';

    $cmd = $db->prepare("select * from proveedores");
    $cmd->execute();

    if(!$cmd){
    	die('Error de consulta ');
    }
    $json = array();
    if($cmd->rowCount() > 0){
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'id' => $registro['prov_id'],
                'razon_social' => $registro['prov_razon_social'],
                'sector_comercial' => $registro['prov_sector_comercial'],
                'tipo_documento' => $registro['prov_tipo_documento'],
                'num_documento' => $registro['prov_num_documento'],
                'direccion' => $registro['prov_direccion'],
                'telefono' => $registro['prov_telefono'],
                'email' => $registro['prov_email'],
                'url' => $registro['prov_url']
            );
        }
        $json_string = json_encode($json);
        echo $json_string;

    }else{
        $response = json_encode(["response" => "No se encontraron usuarios"]);
        echo $response;
    }

?>