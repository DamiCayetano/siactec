<?php

    include '../conexion.php';
    $id = $_POST['id'];
    if (!empty($id)){
        $cmd = $db->prepare("select * from productos where idproducto = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json = array();
        
        while ($registro = $cmd->fetch()){
            $json[] = array(
                'idproducto' => $registro['idproducto'],
                'nombre' => $registro['nombre'],
                'imagen' => base64_encode($registro['imagen']),
                'descripcion' => $registro['descripcion'],
                'cantidad' => $registro['cantidad'],
                'precio' => $registro['precio'],
            );
        }
        $json_string = json_encode($json[0]);
        echo $json_string;
    }

 ?>