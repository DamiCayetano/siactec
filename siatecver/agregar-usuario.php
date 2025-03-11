<?php
    include 'conexion.php';

    /* Const en una varible global
    de tipo constante, es decir nunca cambiara
    su valora */
    const PI = 3.14;


    if (isset($_POST['usuario'])){
        $vusuario = $_POST['usuario'];
        $vclave = $_POST['clave'];
        $vdescripcion = $_POST['descripcion'];
        $cmd = $db->prepare("insert into usuarios(usuario,clave, descripcion) values ('$vusuario','$vclave','$vdescripcion')");
        $cmd->execute();

        if(!$cmd){
            die('Error de consulta ');
        }
        echo "Se agrego satisfactoriamente";
    }
 ?>
