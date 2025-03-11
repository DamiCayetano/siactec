<?php

    require_once '../../conexion.php';

    $id = $_POST['id'];
    
    if (!empty($id)){
        $cmd = $db->prepare("select * from marcas where mar_id = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'mar_id' => $registro['mar_id'],
                'mar_nombre' => $registro['mar_nombre'],
            ];
        }
        $json_string = json_encode($json);
        echo $json_string;
    }

?>