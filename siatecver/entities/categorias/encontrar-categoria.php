<?php

    require_once '../../conexion.php';

    $id = $_POST['id'];
    
    if (!empty($id)){
        $cmd = $db->prepare("select * from categorias where id_categoria = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'id_categoria' => $registro['id_categoria'],
                'nombre_categoria' => $registro['nombre_categoria'],
                'descripcion' => $registro['descripcion']
            ];
        }
        $json_string = json_encode($json);
        echo $json_string;
    }

?>