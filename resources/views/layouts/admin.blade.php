<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Admin</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark text-light sidebar">
            <div class="position-sticky">
                <h4 class="mt-3 text-center">Panel Admin</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">
                            Peticiones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">
                            Categorías
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">
                            Usuarios
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Peticiones</h2>
                <button class="btn btn-primary">Crear Petición</button>
            </div>

            <!-- Tabla de Peticiones -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Firmantes</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Ejemplo de una fila -->
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/50" alt="Foto" class="img-thumbnail">
                        </td>
                        <td>1</td>
                        <td>Petición Ejemplo</td>
                        <td>Descripción corta de la petición...</td>
                        <td>150</td>
                        <td><span class="badge bg-success">Aprobada</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning">Editar</button>
                            <button class="btn btn-sm btn-danger">Borrar</button>
                            <button class="btn btn-sm btn-success">Guardar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/50" alt="Foto" class="img-thumbnail">
                        </td>
                        <td>2</td>
                        <td>Segunda Petición</td>
                        <td>Otra descripción breve...</td>
                        <td>45</td>
                        <td><span class="badge bg-warning">Pendiente</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning">Editar</button>
                            <button class="btn btn-sm btn-danger">Borrar</button>
                            <button class="btn btn-sm btn-success">Guardar</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>










</html>
