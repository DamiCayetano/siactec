$(document).ready(function() {

    const URL_BASE = "http://localhost/"

    let editar = false;

    $('#resultado-producto').hide();

    obtenerProductos();

    $('#search').keyup(function(e){

        if($('#search').val()){

            let search = $('#search').val();
            $.ajax({
                url: URL_BASE+'/siatecver/productos/buscar-producto.php',
                type: 'POST',
                data: {search},
                success: function(response){
                //    console.log(response);

                    let productos = JSON.parse(response);
                    console.log(productos);

                    let plantilla='';
                    productos.forEach(prod => {
                        plantilla += `<li>
                            ${prod.nombre}
                        </li>`
                    });

                    $('#container').html(plantilla);
                    $('#resultado-producto').show();

                }
            });
        }

    });

    $('#productos-form').submit(function(e){
        let postData = new FormData();
        postData.append('idproducto', $('#productoId').val());
        postData.append('producto', $('#producto').val());
        postData.append('descripcion', $('#descripcion').val());
        postData.append('cantidad', $('#cantidad').val());
        postData.append('precio', $('#precio').val());
        postData.append('img', $('#img')[0].files[0]);
        
        let url = editar === false ? 'agregar-producto.php' : 'editar-producto.php'
        if(editar) {
            postData.append('imgactual', $('#img-actual').val());
        } 
        $.ajax({
            url: url, // Archivo PHP que procesará la carga
            type: 'POST',
            data: postData,
            contentType: false, // Importante para enviar datos binarios
            processData: false, // No procesar los datos del formulario
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error al subir la imagen: ' + error);
            }
        });
        
        e.preventDefault();
    });


    function obtenerProductos(){

       $.ajax({

            url: URL_BASE+'/siatecver/productos/listar-producto.php',
            type: 'GET',
            success: function(response){
                let productos = JSON.parse(response);
                let plantilla='';
                productos.forEach(prod => {
                    plantilla += `
                    <tr prodId="${prod.idproducto}">
                        <td>${prod.idproducto}</td>
                        <td><a href="#" class="editarProductos">${prod.nombre}</td>
                        <td><img src="data:image/png;base64,${prod.imagen}" width = "50px" height = "50px"/></td>
                        <td>${prod.descripcion}</td> 
                        <td>${prod.cantidad}</td> 
                        <td>${prod.precio}</td> 
                        <td><button class="eliminarProductos btn btn-danger">Eliminar</button></td>                    
                    </tr>`
                });

                $('#productos').html(plantilla);
                
            }
        }) 
    }

    $(document).on('click','.eliminarProductos',function() {

        if(confirm('Esta seguro de querer eliminar?')){

            let elemento = $(this)[0].parentElement.parentElement;

            let id = $(elemento).attr('prodId');

            $.post(URL_BASE+'/siatecver/productos/eliminar-producto.php', {id},function (response) {
            obtenerProductos();
        }); 
        }       
    });

    $(document).on('click','.editarProductos',function() {

        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;

        let id = $(elemento).attr('prodId');

        $.post(URL_BASE+'/siatecver/productos/encontrar-producto.php', {id},function (response) {

            const producto = JSON.parse(response);

            $('#productoId').val(producto.idproducto);
            $('#producto').val(producto.nombre);
            $('#img');
            $('#img-actual').val(producto.imagen);
            $('#descripcion').val(producto.descripcion);
            $('#cantidad').val(producto.cantidad);
            $('#precio').val(producto.precio);
            
            editar = true;
            obtenerProductos();
        });
    });
    
});
