<?php

    include 'conexion.php';

    if (isset($_POST['usuario'])){
        $vusuario = $_POST['usuario'];
        $vclave = $_POST['clave'];
        $vdescripcion = $_POST['descripcion'];
        $vidusuario = $_POST['idusuario'];

        $cmd = $db->prepare("UPDATE usuarios SET usuario='$vusuario', clave='$vclave', descripcion='$vdescripcion' WHERE idusuario = '$vidusuario'");

        $cmd->execute();

        if($cmd->rowCount() > 0){
            echo "Se actualizo satisfactoriamente";
        }else{
            echo "No se actualiza el usuario  ocurrio une rror en la consulta";
        }

    }
?>