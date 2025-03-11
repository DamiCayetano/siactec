<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">

    <title>Siatec Ajax</title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    -->
</head>

<body>
    <!-- contenedor 1 -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a href="#" class="navbar-brand">Siatec Perú / Proveedores</a>
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
                        <form id="proveedor-form">
                            <input type="hidden" id="proveedor_id" name="proveedor_id" value="" class="form-control">
                            <div class="form-group">
                                <input type="text" id="razon_social" placeholder="Razón social" name="razon_social" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" name="sector_comercial" id="sector_comercial">
                                    <option disabled selected>Seleccione</option>
                                    <option value="comercio_minorista">Comercio Minorista</option>
                                    <option value="servicios_financieros">Servicios Financieros</option>
                                    <option value="construccion">Construcción</option>
                                    <option value="tecnologia">Tecnología</option>
                                    <option value="alimentos_bebidas">Alimentos y bebidas</option>
                                    <option value="salud">Salud</option>
                                    <option value="turismo_viajes">Turismo y viajes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" name="tipo_documento" id="tipo_documento">
                                    <option disabled selected>Seleccione </option>
                                    <option value="dni">DNI (Documento Nacion de Identidad)</option>
                                    <option value="ruc">RUC (Registro Único de Contribuyente)</option>
                                    <option value="carnet_extraneria">Carnét de Extranjería</option>
                                    <option value="pasaporte">Pasaporte</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="num_documento" placeholder="Número de documento" name="num_documento" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="direccion" placeholder="Digite dirección" name="direccion" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="telefono" placeholder="Digite teléfono" name="telefono" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="email" placeholder="example.123@gmail.com" name="email" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="url" placeholder="Suba enlace URL" name="url" value="" class="form-control">
                            </div>
                            <button type="submit" name="guardar" id="guardar" class="btn btn-primary btn-block text-center"> Guardar Proveedor</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card my-4" id="resultado-usuario">
                    <div class="card-body">
                        <ul id="container">
                        </ul>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Proveedor</td>
                            <td>Tipo de documento</td>
                            <td>Número de documento</td>
                        </tr>
                    </thead>
                    <tbody id="listProveedores"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/entidades/proveedor.js"></script>
</body>

</html>