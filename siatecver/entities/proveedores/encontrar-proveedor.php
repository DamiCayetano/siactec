<?php

    require_once '../../conexion.php';

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
        $cmd = $db->prepare("select * from proveedores where prov_id = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }

        $json;
        
        while ($registro = $cmd->fetch()){
            $json = [ 
                'prov_id' => $registro['prov_id'],
                'prov_razon_social' => $registro['prov_razon_social'],
                'prov_sector_comercial' => $registro['prov_sector_comercial'],
                'prov_tipo_documento' => $registro['prov_tipo_documento'],
                'prov_num_documento' => $registro['prov_num_documento'],
                'prov_direccion' => $registro['prov_direccion'],
                'prov_telefono' => $registro['prov_telefono'],
                'prov_email' => $registro['prov_email'],
                'prov_url' => $registro['prov_url']
            ];
        }
        $json_string = json_encode($json);
        echo $json_string;
    }

?>