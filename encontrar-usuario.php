<?php

    include 'conexion.php';

    $id = $_POST['id'];
    /* 
        empty() te permite evaluar una variable para devolver un valor booleano

        ¿Cuando devuelve un true?
        Devolvera true, si es que el valor es vacio

        ¿Cuando devuelve false?
        Devolver false, si es que contiene un valor

        empty("Hola") => false

        empty("") => true
    */
    if (!empty($id)){
        $cmd = $db->prepare("select * from usuarios where idusuario = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'usuario' => $registro['usuario'],
                'clave' => $registro['clave'],
                'descripcion' => $registro['descripcion'],
                'idusuario' => $registro['idusuario']
            ];
        }
        
        $json_string = json_encode($json);
        echo $json_string;
    }

 ?>