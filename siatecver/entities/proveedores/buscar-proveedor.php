<?php

    include '../../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from proveedores where prov_razon_social like '$buscar%'");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        $json = array();
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'razon_social' => $registro['prov_razon_social'],
                'tipo_documento' => $registro['prov_tipo_documento'],
                'prov_id' => $registro['prov_id']
            );
		}

        $json_string = json_encode($json);
        echo $json_string;
    }

    ?>
