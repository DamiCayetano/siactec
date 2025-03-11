$(document).ready(function () {

    console.log("hola")
    console.log('Jquery installed');
    const URL_BASE = "http://localhost/"

    let editar = false;

    $('#resultado-usuario').hide();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({

                url: URL_BASE + '/siatecver/entities/categorias/buscar-categoria.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    //    console.log(response);
                    let categoria = JSON.parse(response);
                    console.log(categoria);

                    let plantilla = '';
                    categoria.forEach(categoria => {
                        plantilla += `
                            <li> ${categoria.nombre_categoria}</li>
                            `
                    });

                    $('#container').html(plantilla);
                    $('#resultado-usuario').show();

                }
            });
        }

    });

    $('#categoria-form').submit(function (e) {
        let fecha = new Date()
        const postData = {
            id_categoria: $('#id_categoria').val(),
            nombre_categoria: $('#nombre_categoria').val(),
            descripcion: $('#descripcion').val(),
            guardar: "asda"
        };
        console.log(postData)

        let url = editar === false ? 'agregar-categoria.php' : 'editar-categoria.php'

        $.post(URL_BASE + '/siatecver/entities/categorias/' + url, postData, function (response) {
            console.log(response)
            obtenerCategorias();

            $('#categoria-form').trigger('reset').find('input, textarea, select').val('');

        });
        e.preventDefault();
    });

    function obtenerCategorias() {
        $.ajax({
            url: URL_BASE + '/siatecver/entities/categorias/listar-categoria.php',
            type: 'GET',
            success: function (response) {
                let categoria = JSON.parse(response);
                let plantilla = '';
                if (Array.isArray(categoria)) {

                    categoria.forEach(categoria => {
                        plantilla += `
                            <tr userId="${categoria.id_categoria}">
                                <td>${categoria.id_categoria}</td>
                                <td><a href="#" class="editarCategoria">${categoria.nombre_categoria}</a></td> 
                                <td>${categoria.descripcion}</td> 
                                <td><button class="eliminarCategoria btn btn-danger">Eliminar</button></td>                    
                            </tr>`
                    });

                } else {
                    plantilla += `
                    <tr >
                        <td>${categoria.response}</td>
                    </tr>`
                }


                $('#listCategorias').html(plantilla);

            }
        })
    }
    obtenerCategorias();

    $(document).on('click', '.eliminarCategoria', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            let elemento = $(this)[0].parentElement.parentElement
            let id = $(elemento).attr('userId');
            $.post(URL_BASE + 'siatecver/entities/categorias/eliminar-categoria.php', { id }, function (response) {
                obtenerCategorias();
            });
        }
    });

    /* PRIMERO BUSCAMOS AL EMPLEADO */
    $(document).on('click', '.editarCategoria', function () {
        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + '/siatecver/entities/categorias/encontrar-categoria.php', { id }, function (response) {
            const categoria = JSON.parse(response);
            console.log(categoria)
            $('#id_categoria').val(categoria.id_categoria),
                $('#nombre_categoria').val(categoria.nombre_categoria),
                $('#descripcion').val(categoria.descripcion)

            editar = true;

            obtenerCategorias();

        });

    });
});