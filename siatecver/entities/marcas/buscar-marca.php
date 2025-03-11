<?php

    include '../../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from marcas where mar_nombre like '$buscar%'");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        $json = array();
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'mar_nombre' => $registro['mar_nombre'],
                'mar_id' => $registro['mar_id']
            );
		}

        $json_string = json_encode($json);
        echo $json_string;
    }

    ?>