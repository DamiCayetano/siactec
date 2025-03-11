$(document).ready(function () {

    const URL_BASE = "http://localhost/"

    let editar = false;

    $('#resultado-marca').hide();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({

                url: URL_BASE + '/siatecver/entities/marcas/buscar-marca.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    //    console.log(response);
                    let marcas = JSON.parse(response);
                    console.log(marcas);

                    let plantilla = '';
                    
                    marcas.forEach(marca => {
                        plantilla += `
                            <li> ${marca.mar_nombre}</li>
                            `
                    });
                    $('#container').html(plantilla);
                    $('#resultado-marca').show();
                }
            });
        }
    });

    $('#marca-form').submit(function (e) {
        let fecha = new Date()
        const postData = {
            mar_id: $('#mar_id').val(),
            mar_nombre: $('#mar_nombre').val(),
            guardar: "asda"
        };
        console.log(postData)

        let url = editar === false ? 'agregar-marcas.php' : 'editar-marca.php'

        $.post(URL_BASE + '/siatecver/entities/marcas/' + url, postData, function (response) {
            console.log(response)
            obtenerMarcas();

            $('#marca-form').trigger('reset').find('input, textarea, select').val('');

        });
        e.preventDefault();
    });

    function obtenerMarcas() {
        $.ajax({
            url: URL_BASE + '/siatecver/entities/marcas/listar-marcas.php',
            type: 'GET',
            success: function (response) {
                let marca = JSON.parse(response);
                let plantilla = '';
                if (Array.isArray(marca)) {

                    marca.forEach(marca => {
                        plantilla += `
                            <tr userId="${marca.mar_id}">
                                <td>${marca.mar_id}</td>
                                <td><a href="#" class="editarMarca">${marca.mar_nombre}</a></td> 
                                <td><button class="eliminarMarca btn btn-danger">Eliminar</button></td>                    
                            </tr>`
                    });

                } else {
                    plantilla += `
                    <tr >
                        <td>${marca.response}</td>
                    </tr>`
                }

                $('#listMarcas').html(plantilla);

            }
        })
    }
    obtenerMarcas();

    $(document).on('click', '.eliminarMarca', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            let elemento = $(this)[0].parentElement.parentElement
            let id = $(elemento).attr('userId');
            $.post(URL_BASE + 'siatecver/entities/marcas/eliminar-marca.php', { id }, function (response) {
                obtenerMarcas();
            });
        }
    });

    /* PRIMERO BUSCAMOS AL EMPLEADO */
    $(document).on('click', '.editarMarca', function () {
        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + '/siatecver/entities/marcas/encontrar-marca.php', { id }, function (response) {
            const marca = JSON.parse(response);
            console.log(marca)
            $('#mar_id').val(marca.mar_id),
            $('#mar_nombre').val(marca.mar_nombre),

            editar = true;

            obtenerMarcas();

        });

    });
});