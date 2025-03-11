<?php

    include '../../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from categorias where nombre_categoria like '$buscar%'");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        $json = array();
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'nombre_categoria' => $registro['nombre_categoria'],
                'descripcion' => $registro['descripcion'],
                'id_categoria' => $registro['id_categoria']
            );
		}

        $json_string = json_encode($json);
        echo $json_string;
    }

    ?>