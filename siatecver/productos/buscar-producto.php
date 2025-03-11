<?php

    include '../conexion.php';
    $buscar = $_POST['search'];
    if (!empty($buscar)){
        $cmd = $db->prepare("select * from productos where nombre like '$buscar%'");
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
        $json_string = json_encode($json);
        echo $json_string;
    }

 ?>
