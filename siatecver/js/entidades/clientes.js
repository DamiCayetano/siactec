$(document).ready(function () {

    const URL_BASE = "http://localhost/"

    let editar = false;

    $('#resultado-cliente').hide();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({

                url: URL_BASE + '/siatecver/entities/clientes/buscar-cliente.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    //    console.log(response);
                    let clientes = JSON.parse(response);
                    console.log(clientes);

                    let plantilla = '';
                    
                    clientes.forEach(cliente => {
                        plantilla += `
                            <li> ${cliente.cli_nombre}</li>
                            `
                    });
                    $('#container').html(plantilla);
                    $('#resultado-cliente').show();
                }
            });
        }
    });

    $('#cliente-form').submit(function (e) {
        const postData = {
            cli_id: $('#cli_id').val(),
            cli_nombre: $('#cli_nombre').val(),
            cli_apellido: $('#cli_apellido').val(),
            cli_telefono: $('#cli_telefono').val(),
            guardar: "asda"
        };
        console.log(postData)

        let url = editar === false ? 'agregar-clientes.php' : 'editar-cliente.php'

        $.post(URL_BASE + '/siatecver/entities/clientes/' + url, postData, function (response) {
            console.log(response)
            obtenerClientes();

            $('#cliente-form').trigger('reset').find('input, textarea, select').val('');
            editar = false

        });
        e.preventDefault();
    });

    function obtenerClientes() {
        $.ajax({
            url: URL_BASE + '/siatecver/entities/clientes/listar-clientes.php',
            type: 'GET',
            success: function (response) {
                let clientes = JSON.parse(response);
                let plantilla = '';
                if (Array.isArray(clientes)) {
                    clientes.forEach(cliente => {
                        plantilla += `
                            <tr userId="${cliente.cli_id}">
                                <td>${cliente.cli_id}</td>
                                <td><a href="#" class="editarCliente">${cliente.cli_nombre}</a></td> 
                                <td>${cliente.cli_apellido}</td> 
                                <td><button class="eliminarCliente btn btn-danger">Eliminar</button></td>                    
                            </tr>`
                    });

                } else {
                    plantilla += `
                    <tr >
                        <td>${clientes.response}</td>
                    </tr>`
                }

                $('#listaClientes').html(plantilla);

            }
        })
    }
    obtenerClientes();

    $(document).on('click', '.eliminarCliente', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            let elemento = $(this)[0].parentElement.parentElement
            let id = $(elemento).attr('userId');
            $.post(URL_BASE + 'siatecver/entities/clientes/eliminar-cliente.php', { id }, function (response) {
                obtenerClientes();
            });
        }
    });

    /* PRIMERO BUSCAMOS AL EMPLEADO */
    $(document).on('click', '.editarCliente', function () {
        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + '/siatecver/entities/clientes/encontrar-cliente.php', { id }, function (response) {
            const cliente = JSON.parse(response);
            console.log(cliente)
            $('#cli_id').val(cliente.cli_id),
            $('#cli_nombre').val(cliente.cli_nombre),
            $('#cli_apellido').val(cliente.cli_apellido),
            $('#cli_telefono').val(cliente.cli_telefono),

            editar = true;

            obtenerClientes();

        });

    });
});