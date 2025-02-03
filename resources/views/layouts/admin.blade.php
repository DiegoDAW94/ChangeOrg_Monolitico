<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #dc3545; /* Rojo similar al anterior */
            color: white;
            min-height: 100vh;
            padding: 15px;
            position: fixed;
            width: 250px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: white;
            font-size: 16px;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: #bd2130;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background-color: #f8f9fa;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .btn-danger {
            margin-left: auto;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center">
            <img src="https://via.placeholder.com/80" class="rounded-circle mb-3" alt="Admin">
            <h4>Admin</h4>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('admin.peticiones.index') }}" class="nav-link">Peticiones</a>
            <a href="{{ route('admin.categorias.index') }}" class="nav-link">Categorías</a>
            <a href="{{ route('admin.users.index') }}" class="nav-link">Usuarios</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content w-100">
        <!-- Navbar -->
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                </form>
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
        </nav>

        <!-- Dynamic Content -->
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>









</html>
