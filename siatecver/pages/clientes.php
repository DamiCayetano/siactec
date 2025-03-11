<!DOCTYPE html>
<html lang="es-pe" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Siatec Ajax</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>

<body>
    <!-- contenedor 1 -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a href="#" class="navbar-brand">Siatec Perú / Clientes</a>
                    <ul class="navbar-nav ml-auto">
                        <details class="text-light position-relative m-2">
                            <summary>Paginas</summary>
                            <ul class="position-absolute card text-light p-0 list-group" style="z-index: 5;">
                                <li class="list-group-item"><a href="../index.html">Usuario</a></li>
                                <li class="list-group-item"><a href="../productos/index.html">Productos</a></li>
                                <li class="list-group-item"><a href="../pages/proveedores.php">Provedores</a></li>
                                <li class="list-group-item"><a href="../pages/marcas.php">Marca</a></li>
                                <li class="list-group-item"><a href="../pages/empleados.php">Empleados</a></li>
                                <li class="list-group-item"><a href="clientes.php">Clientes</a></li>
                                <li class="list-group-item"><a href="../pages/categoria.php">Categorias</a></li>
                            </ul>
                        </details>
                        <form class="form-inline my-2 my-lg-0">
                            <input type="search" id="search" name="" value="" class="form-control mr-sm-2" placeholder="Busque al usuario">
                            <button type="submit" name="button" class="btn btn-success my-2 my-sm-0" id="">Buscar</button>
                        </form>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- contenedor 2 -->
    <div class="container p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form id="cliente-form">
                            <input type="hidden" id="cli_id" name="cli_id" value="" class="form-control">
                            <div class="form-group">
                                <input type="text" id="cli_nombre" placeholder="Nombre" name="cli_nombre" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="cli_apellido" placeholder="Apellido" name="cli_apellido" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="cli_telefono" placeholder="Telefono" name="cli_telefono" value="" class="form-control">
                            </div>

                            <button type="submit" name="guardar" id="guardar" class="btn btn-primary btn-block text-center"> Guardar Clientes</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card my-4" id="resultado-cliente">
                    <div class="card-body">
                        <ul id="container">
                        </ul>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nombre</td>
                        </tr>
                    </thead>
                    <tbody id="listaClientes"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/entidades/clientes.js"></script>
</body>

</html>