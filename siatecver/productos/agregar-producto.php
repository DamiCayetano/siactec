<?php
    include '../conexion.php';
    if (isset($_POST['producto'])){
        $vname = $_POST['producto'];
        $vdescripcion = $_POST['descripcion'];
        $vcantidad = $_POST['cantidad'];
        $vprecio = $_POST['precio'];
        
        $vimage = $_FILES['img'];
        $fileContent =file_get_contents($vimage["tmp_name"]);
        $cmd = $db->prepare("INSERT INTO productos (nombre, imagen, descripcion, cantidad, precio) VALUES (?, ?, ?, ?, ?)");
        $cmd->bindParam(1, $vname, PDO::PARAM_STR);       // nombre
        $cmd->bindParam(2, $fileContent, PDO::PARAM_LOB); // imagen (BLOB)
        $cmd->bindParam(3, $vdescripcion, PDO::PARAM_STR); // descripcion
        $cmd->bindParam(4, $vcantidad, PDO::PARAM_INT);    // cantidad
        $cmd->bindParam(5, $vprecio, PDO::PARAM_STR);  
        if($cmd->execute()) {
            echo "Se agrego satisfactoriamente";
        }
        if(!$cmd){
            die('Error de consulta ');
        }
    }
 ?>
