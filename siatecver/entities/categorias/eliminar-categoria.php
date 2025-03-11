<?php

    include '../../conexion.php';

    $id = $_POST['id'];
    if (!empty($id)){
        $cmd = $db->prepare("delete from categorias where id_categoria = $id");
        $cmd->execute();
        if(!$cmd){
            die('Error de consulta ');
        }
        
        echo "Tarea completada";
    }

?>