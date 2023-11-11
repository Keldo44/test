<?php
session_start();
$_SESSION['id'];
$_SESSION['usuario'];
if ($_SESSION['admin'] == 1) {
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?= $_SESSION['usuario'] ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="leerProductos.php">Leer productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="actualizarProductos.php">Actualizar productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="borrarProductos.php">Borrar productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="actualizarUsuarios">Usuarios</a>
                    </li>
                </ul>
                <button class="delete btn btn-outline-light" type="submit"><a style="text-decoration: none; color:white"
                        onclick="cerrarSesion(event)" href="Login.php">Logout</a></button>
            </div>
    </nav>
    <div class="container mt-3">
        <h2>Actualizar Usuarios</h2>
        <h3>Introduzca el id del registro que quiera <strong>actualizar</strong></h3>
        <form action="consultas.php" method="get">
            <div class="mb-3 mt-3">
                <label for="">ID:</label>
                <input type="number" class="form-control" id="id" placeholder="Inserte el ID" name="id">
            </div>
            <div class="mb-3 mt-3">
                <label for="">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
            </div>
            
            <div class="mb-3">
                <label for="">Admin:</label> </br>
                <input type="hidden" name="admin" value="0">
                <input type="checkbox" id="admin" name="admin" value="1">
            </div>
            <div class="mb-3 mt-3">
                <label for="">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" name="apellidos">
            </div>
            <div class="mb-3">
                <label for="">Contraseña:</label>
                <input type="password" class="form-control" id="pass" placeholder="Contraseña" name="pass">
            </div>
            <div class="mb-3">
                <label for="">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email">
            </div>
            <div class="mb-3 row" style="justify-content:center">
                <button type="submit" class="btn btn-dark col-6" name="updateUserBtn"
                    onclick="notificarUpdate()">Enviar</button>
            <div>
        </form>
    </div>

    <div class="container mt-3">
        <h2>Borrar Usuarios</h2>
        <h3>Introduzca el id del registro que quiera <strong>borrar</strong></h3>
        <form action="consultas.php" method="get">
            <div class="mb-3 mt-3">
                <label for="">ID:</label>
                <input type="number" class="form-control" id="id" placeholder="Inserte el ID" name="id">
            </div>
            
            <div class="mb-3 row" style="justify-content:center">
                <button type="submit" class="btn btn-dark col-6" name="borrarUserBtn">Enviar</button>
            <div>
        </form>
    </div>

</body>

</html>
<?php
}else{
    echo"You are not allowed to be here";
}?>
<script type="text/javascript">
    $(document).ready(function () {

    });

    function notificarUpdate() {
        swal({
            title: "Se han enviado los datos a actualizar!",
            text: "Datos enviados correctamente!!",
            icon: "success",
            button: "Ok",
            timer: 10000
        });
    }

    function cerrarSesion(event) {
        event.preventDefault();
        swal({
            title: "Seguro desea cerrar sesión?",
            text: "Una vez cerrada tendrá que logear de nuevo",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Redirigiendo...", {
                        icon: "success",
                    });
                    window.location.href = "Login.php";
                } else {
                    swal("Su sesión no se ha cerrado");
                }
            });
    }

</script>