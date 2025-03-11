<!DOCTYPE html>
<html lang="es-pe">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a href="#" class="navbar-brand">Siatec Perú</a>
                    <ul class="navbar-nav ml-auto">

                        <details class="text-light position-relative m-2">
                            <summary>Paginas</summary>
                            <ul class="position-absolute card text-light p-0 list-group" style="z-index: 5;">
                                <li class="list-group-item"><a href="#">Inicio</a></li>
                                <li class="list-group-item"><a href="./productos/index.html">Productos</a></li>
                                <li class="list-group-item"><a href="./pages/proveedores.php">Provedores</a></li>
                                <li class="list-group-item"><a href="./pages/categoria.php">Categoria</a></li>
                                <li class="list-group-item"><a href="./pages/clientes.php">Clientes</a></li>
                                <li class="list-group-item"><a href="./pages/empleados.php">Empleados</a></li>
                                <li class="list-group-item"><a href="./pages/marcas.php">Marcas</a></li>
                            </ul>
                        </details>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <main class="container d-flex justify-content-center align-items-center " style="height: 80vh;">
        <article class="bg-dark text-light p-5 rounded text-center">
            <h1>Siatec Perú</h1>
            <p>Ingresa tu cuenta para acceder</p>
            <form id="login-form" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="email" id="emp_correo" name="emp_correo" class="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="emp_contrasena" name="emp_contrasena" class="form-control" placeholder="Ingresa tu contraseña" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">password</span>
                    </div>
                </div>
                <button id="buscar-login" type="button" class="btn btn-light btn-block buscar_login">Enviar</button>
                <div id="result-login"></div>
            </form>
        </article>
    </main>
    <script src="js/entidades/login.js"></script>
</body>

</html>