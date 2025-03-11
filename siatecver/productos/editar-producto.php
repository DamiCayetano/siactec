<?php
    include '../conexion.php';

    if (isset($_POST['producto'])){
        $vidproducto = $_POST['idproducto'];
        $vname = $_POST['producto'];
        $vdescripcion = $_POST['descripcion'];
        $vcantidad = $_POST['cantidad'];
        $vprecio = $_POST['precio'];
        
        // $vimage = $vimageActual;
        if(!empty($_FILES['img']['name'])) {
            $vimageNueva = $_FILES['img'];
            $vimage = file_get_contents($vimageNueva["tmp_name"]);
            /* echo "imagen nueva"; */
        } else {
            $vimage =base64_decode( $_POST['imgactual']);
    
            /* echo "imagen antigua". $vimage; */
        }

        $cmd = $db->prepare("
            UPDATE productos SET 
            nombre = :nombre, 
            imagen = :imagen, 
            descripcion = :descripcion, 
            cantidad = :cantidad, 
            precio = :precio 
            WHERE idproducto = :idproducto
        ");
        $cmd->bindParam(':nombre', $vname);
        $cmd->bindParam(':imagen', $vimage, PDO::PARAM_LOB);
        $cmd->bindParam(':descripcion', $vdescripcion);
        $cmd->bindParam(':cantidad', $vcantidad);
        $cmd->bindParam(':precio', $vprecio);
        $cmd->bindParam(':idproducto', $vidproducto);
        $cmd->execute();

        if(!$cmd){
            die('Error de consulta ');
        }
        echo "Se actualizo satisfactoriamente";
    }
 ?>
