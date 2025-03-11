$(document).ready(function () {

    console.log('Jquery installed');
    const URL_BASE = "http://localhost";

    let editar = false;

    $('#resultado-usuario').hide();

    obtenerUsuarios();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();
            
            $.ajax({
                url: URL_BASE + '/siatecver/buscar-usuario.php',
                type: 'POST',
                data: { search},
                success: function (response) {
                    console.log(response);
                    let usuarios = JSON.parse(response);

                    let plantilla = '';
                    usuarios.forEach(usuario => {
                        plantilla += `<li>
                            ${usuario.usuario}
                        </li>`
                    });

                    $('#container').html(plantilla);
                    $('#resultado-usuario').show();

                }
            });
        }

    });

    $('#usuarios-form').submit(function (e) {

        const postData = {
            usuario: $('#usuario').val(),
            clave: $('#clave').val(),
            descripcion: $('#descripcion').val(),
            idusuario: $('#usuarioId').val()
        };
        /* 
            EL operador ternario ejecutara instrucciones dependiendo al
            valor devuelto

            __condicion__ ? _si_es_true_ : _si_es_false

            num1 = 5
            num2 = 10

            num1 > num2 ? "Si es mayor que num2" : "No, no es mayor que num2"
        */
        let url = editar === false ? 'agregar-usuario.php' : 'editar-usuario.php'

        $.post(URL_BASE + '/siatecver/' + url, postData, function (response) {
            
            obtenerUsuarios();

            $('#usuarios-form').trigger('reset');

        });
        e.preventDefault();
    });

    function obtenerUsuarios() {
        $.ajax({
            url: URL_BASE + '/siatecver/listar-usuario.php',
            type: 'GET',
            success: function (response) {
                let usuarios = JSON.parse(response);

                let plantilla = '';

                usuarios.forEach(usuario => {
                    plantilla += `
                    <tr userId="${usuario.idusuario}">
                        <td>${usuario.idusuario}</td>
                        <td>
                            <a href="#" class="editarUsuarios">${usuario.usuario}
                        </td>
                        <td>${usuario.descripcion}</td> 
                        <td>
                            <button class="eliminarUsuarios btn btn-danger">Eliminar</button>
                        </td>                    
                    </tr>`
                });

                $('#usuarios').html(plantilla);

            }
        })
    }

    $(document).on('click', '.eliminarUsuarios', function () {
        if (confirm('Esta seguro de querer eliminar?')) {
            /* PARENTELEMENT = Captura a mi padre */
            /* $this = devuelve un objeto de JQUery
                pero accedemos al primer valor, para que
                nos devuelva el elemento que dimos clic */
            let elemento = $(this)[0].parentElement.parentElement

            let id = $(elemento).attr('userId');

            /* post = funcion de JQUERY 
            que te permite realizar una petición HTTP de tipo
            POST 
                $.post(url,datos,function())

                Object Property Shorthand
                Si la clave y valor, son el mismo nombre, entonces podemos
                resumir el objeto

                tradicional => nombre: nombre
                moderno => nombre
            */

            $.post(URL_BASE + '/siatecver/eliminar-usuario.php', { id }, function (response) {
                obtenerUsuarios();
            });
        }
    });

    $(document).on('click', '.editarUsuarios', function () {

        console.log('editando');

        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('userId');

        /* ESTA LLAMANDO PRIMERO AL USUARIO */
        $.post(URL_BASE + '/siatecver/encontrar-usuario.php', { id }, function (response) {
            const usuario = JSON.parse(response);
            $('#usuario').val(usuario.usuario);
            $('#clave').val(usuario.clave);
            $('#descripcion').val(usuario.descripcion);
            $('#usuarioId').val(usuario.idusuario);

            editar = true;

            /* obtenerUsuarios(); */

        });

    });

});
