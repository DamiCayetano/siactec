$(document).ready(function () {

    console.log("hola")
    console.log('Jquery installed');
    const URL_BASE = "http://localhost/"

    let editar = false;

    $('#resultado-empleado').hide();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({

                url: URL_BASE + '/siatecver/entities/empleados/buscar-empleados.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    //    console.log(response);
                    let empleados = JSON.parse(response);
                    console.log(empleados);

                    let plantilla = '';
                    empleados.forEach(empleado => {
                        plantilla += `
                            <li> ${empleado.emp_nombre}</li>
                            `
                    });

                    $('#container').html(plantilla);
                    $('#resultado-empleado').show();

                }
            });
        }

    });

    $('#empleados-form').submit(function (e) {
        const postData = {
            emp_id: $('#emp_id').val(),
            emp_nombre: $('#emp_nombre').val(),
            emp_apellido: $('#emp_apellido').val(),
            emp_cargo: $('#emp_cargo').val(),
            emp_telefono: $('#emp_telefono').val(),
            emp_email: $('#emp_email').val(),
            emp_contrasena: $('#emp_contrasena').val(),
            guardar: "asda"
        };
        console.log(postData)

        let url = editar === false ? 'agregar-empleados.php' : 'editar-empleados.php'

        $.post(URL_BASE + 'siatecver/entities/empleados/' + url, postData, function (response) {
            console.log(response)
            obtenerEmpleados();

            $('#empleados-form').trigger('reset').find('input, textarea, select').val('');
            editar = false
        });
        e.preventDefault();
    });

    function obtenerEmpleados() {
        $.ajax({
            url: URL_BASE + 'siatecver/entities/empleados/listar-empleados.php',
            type: 'GET',
            success: function (response) {
                console.log(response)
                let empleados = JSON.parse(response);
                let plantilla = '';
                if (Array.isArray(empleados)) {

                    empleados.forEach(empleado => {
                        plantilla += `
                            <tr userId="${empleado.emp_id}">
                                <td>${empleado.emp_id}</td> 
                                <td><a href="#" class="editarEmpleado">${empleado.emp_nombre}</td>
                                <td>${empleado.emp_apellido}</td> 
                                <td>${empleado.emp_cargo}</td> 
                                <td><button class="eliminarEmpleado btn btn-danger">Eliminar</button></td>                    
                            </tr>`
                    });

                } else {
                    plantilla += `
                    <tr >
                        <td>${empleados.response}</td>
                    </tr>`
                }


                $('#listEmpleados').html(plantilla);

            }
        })
    }
    obtenerEmpleados();

    $(document).on('click', '.eliminarEmpleado', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            let elemento = $(this)[0].parentElement.parentElement
            let emp_id = $(elemento).attr('userId');
            $.post(URL_BASE + 'siatecver/entities/empleados/eliminar-empleado.php', { emp_id }, function (response) {
                obtenerEmpleados();
            });
        }
    });

    /* PRIMERO BUSCAMOS AL PROVEEDOR */
    $(document).on('click', '.editarEmpleado', function () {
        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + 'siatecver/entities/empleados/encontrar-empleado.php', { id }, function (response) {
            const empleado = JSON.parse(response);
            console.log(empleado)
            $('#emp_id').val(empleado.emp_id),
            $('#emp_nombre').val(empleado.emp_nombre),
            $('#emp_cargo').val(empleado.emp_cargo),
            $('#emp_apellido').val(empleado.emp_apellido),
            $('#emp_telefono').val(empleado.emp_telefono),
            $('#emp_email').val(empleado.emp_email),
            $('#emp_contrasena').val(empleado.emp_contrasena),

            editar = true;

            obtenerEmpleados();

        });

    });
});
