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

                url: URL_BASE + '/siatecver/entities/proveedores/buscar-proveedor.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    //    console.log(response);
                    let proveedor = JSON.parse(response);
                    console.log(proveedor);

                    let plantilla = '';
                    proveedor.forEach(proveedor => {
                        plantilla += `
                            <li> ${proveedor.razon_social}</li>
                            `
                    });

                    $('#container').html(plantilla);
                    $('#resultado-usuario').show();

                }
            });
        }

    });

    $('#proveedor-form').submit(function (e) {
        let fecha = new Date()
        const postData = {
            id: $('#proveedor_id').val(),
            razon_social: $('#razon_social').val(),
            sector_comercial: $('#sector_comercial').val(),
            tipo_documento: $('#tipo_documento').val(),
            num_documento: $('#num_documento').val(),
            direccion: $('#direccion').val(),
            telefono: $('#telefono').val(),
            email: $('#email').val(),
            url: $('#url').val(),
            guardar: "asda",
            fecha_creacion: fecha
        };
        console.log(postData)

        let url = editar === false ? 'agregar-proveedor.php' : 'editar-proveedor.php'

        $.post(URL_BASE + '/siatecver/entities/proveedores/' + url, postData, function (response) {
            console.log(response)
            obtenerProveedores();

            $('#proveedor-form').trigger('reset').find('input, textarea, select').val('');

        });
        e.preventDefault();
    });

    function obtenerProveedores() {
        $.ajax({
            url: URL_BASE + '/siatecver/entities/proveedores/listar-proveedor.php',
            type: 'GET',
            success: function (response) {
                let proveedor = JSON.parse(response);
                let plantilla = '';
                if (Array.isArray(proveedor)) {

                    proveedor.forEach(proveedor => {
                        plantilla += `
                            <tr userId="${proveedor.id}">
                                <td>${proveedor.id}</td>
                                <td><a href="#" class="editarProveedor">${proveedor.razon_social}</td>
                                <td>${proveedor.tipo_documento}</td> 
                                <td>${proveedor.telefono}</td> 
                                <td><button class="eliminarProveedor btn btn-danger">Eliminar</button></td>                    
                            </tr>`
                    });

                } else {
                    plantilla += `
                    <tr >
                        <td>${proveedor.response}</td>
                    </tr>`
                }


                $('#listProveedores').html(plantilla);

            }
        })
    }
    obtenerProveedores();

    $(document).on('click', '.eliminarProveedor', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            let elemento = $(this)[0].parentElement.parentElement
            let id = $(elemento).attr('userId');
            $.post(URL_BASE + 'siatecver/entities/proveedores/eliminar-proveedor.php', { id }, function (response) {
                obtenerProveedores();
            });
        }
    });

    /* PRIMERO BUSCAMOS AL EMPLEADO */
    $(document).on('click', '.editarProveedor', function () {
        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + '/siatecver/entities/proveedores/encontrar-proveedor.php', { id }, function (response) {
            const proveedor = JSON.parse(response);
            console.log(proveedor)
            $('#proveedor_id').val(proveedor.prov_id),
                $('#razon_social').val(proveedor.prov_razon_social),
                $('#sector_comercial').val(proveedor.prov_sector_comercial),
                $('#tipo_documento').val(proveedor.prov_tipo_documento),
                $('#num_documento').val(proveedor.prov_num_documento),
                $('#direccion').val(proveedor.prov_direccion),
                $('#telefono').val(proveedor.prov_telefono),
                $('#email').val(proveedor.prov_email),
                $('#url').val(proveedor.prov_url)

            editar = true;

            obtenerProveedores();

        });

    });
});
