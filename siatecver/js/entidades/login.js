$(document).ready(function () {

    const URL_BASE = "http://localhost/"

    $(document).on('click', '.buscar_login', function () {
        let posData = {
            emp_correo: $('#emp_correo').val(),
            emp_contrasena: $('#emp_contrasena').val()
        };

        $.post(URL_BASE + '/siatecver/entities/login/validar.php', posData, function (response) {
            console.log(response)
            const login = JSON.parse(response);
            if(login.response == "Usuario autenticado"){
                window.location.href = URL_BASE + '/siatecver/index.html'
            }
            let plantilla = ""
            if (Array.isArray(login)) {
                plantilla += `
                    ${login.response}
                `
            } else {
                plantilla += `
                <tr >
                    <td>${login.response}</td>
                </tr>`
            }

            $('#result-login').html(plantilla);

        });
       
    });

 
});