<?php

session_start();
$iduser = $_SESSION['id'];
$_SESSION['usuario'];
$_SESSION['admin'];


/*
$nombre = $_GET['nombre'];
$precio = $_GET['precio'];
$cantidad = $_GET['cantidad'];
$descripcion = $_GET['descripcion'];*/
$buscador = NULL;

$servidor="localhost";
$usuario="root";
$password="";
$bd="daw2";

$con=mysqli_connect($servidor,$usuario,$password,$bd);

if($_SESSION['admin'] == 1){
  if($con){
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Leer Formulario</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>    
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      </head>
      <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand" href="#"><?=$_SESSION['usuario']?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="main.php">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link  active" href="leerProductos.php">Leer productos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="actualizarProductos.php">Actualizar productos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="borrarProductos.php">Borrar productos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="actualizarUsuarios.php">Usuarios</a>
                      </li>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-2" type="search" placeholder="Buscador por ID o Nombre" name="buscador" aria-label="Buscador por ID">
                      <button class="btn btn-outline-light" type="submit" name="" style="margin-right:10px ;">Buscar</button>
                    </form>
                    <button class="delete btn btn-outline-light" type="submit"><a style="text-decoration: none; color:white" onclick="cerrarSesion(event)" 
                    href="Login.php">Logout</a></button>
                </div>
              </div>
        </nav>
      <div class="container mt-3">
      <h1 style="text-align:center">Listado de productos</h1>
      <h3 style="text-align:center">Si desea añadir al carrito presione en cualquiera de las filas</h3>
      <?php 
      $sort = 'ASC';
      echo"
      <a href='?order=price&&sort=$sort'>Ordenar por Precio</a>
      ".'
        <table class="table table-dark table-hover">
          <tbody>
            <tr>
              <th>ID Producto</th>
              <th>Nombre Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Descripción</th>
            </tr>';
           
            //var_dump($buscador);
            if(isset($_GET['sort'])){
              $sort = $_GET['sort'];
              $order = 'precio';
              $sql2="SELECT  *,productos.nombre AS 'pname',productos.id AS 'idp',c.nombre AS 'desc' FROM `productos`, `categoria`AS c where id_category = c.id ORDER BY $order $sort";
              //buscador($con,$buscador);
            }else{
              //var_dump($_GET['buscador']);
              $sql2="SELECT  *,productos.nombre AS 'pname',productos.id AS 'idp',c.nombre AS 'desc' FROM `productos`, `categoria`AS c where id_category = c.id";
            }
            $consulta=mysqli_query($con,$sql2);
              while($fila=$consulta->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>".$fila["idp"]."</td>";
                  echo "<td>".$fila["pname"]."</td>";
                  echo "<td>".$fila["cantidad"]."</td>";
                  echo "<td>".$fila["precio"]."</td>";
                  echo "<td>".$fila["desc"]."</td>";
                  echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>

          <form action="/logout.php" method="get">

      </form>
      </body>
    </html>
    <?php
  }}else{
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Leer Formulario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"><?=$_SESSION['usuario']?></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="leerProductos.php">Leer productos</a>
                    </li>
                  </ul>
                  <a href="carrito.php" style="padding-right:5%"><i class="fa fa-cart-plus" aria-hidden="true" style="color:white;font-size:40px;padding-right:5%"></i></a>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscador por ID o nombre" name="buscador" aria-label="Buscador por ID">
                    <button class="btn btn-outline-light" type="submit" name="" style="margin-right:10px ;">Buscar</button>
                  </form>
                  <button class="delete btn btn-outline-light" type="submit"><a style="text-decoration: none; color:white" onclick="cerrarSesion(event)" 
                  href="Login.php">Logout</a></button>
              </div>
            </div>
      </nav>
    <div class="container mt-3">
    <h1 style="text-align:center">Listado de productos</h1>
    <?php
    $sort = 'ASC';
    echo"
      <a href='?order=price&&sort=$sort'>Precio</a>
      ".'
        <table class="table table-dark table-hover">
          <tbody>
            <tr>
              <th>ID Producto</th>
              <th>Nombre Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Descripción</th>
            </tr>';
           
            //var_dump($buscador);
            if(isset($_GET['sort'])){
              $sort = $_GET['sort'];
              $order = 'precio';
              $sql2="SELECT * FROM `productos` ORDER BY $order $sort";
            }else{
            //var_dump($_GET['buscador']);
            $sql2="SELECT * FROM `productos`";
          }
          $consulta=mysqli_query($con,$sql2);
          while($fila=$consulta->fetch_assoc()){
            ?>
            <form action="consultas.php" method="get">
              <tr>
              <td><?=$fila['id']?></td>
              <td><?=$fila['nombre']?></td>
              <td><?=$fila['cantidad']?></td>
              <td><?=$fila['precio']?></td>
              <td><?=$fila['id_category']?></td>
              <td>
                <button type="submit" style="color:black;font-size:20px;padding-right:5%" 
                  value = "<?=$fila['id']?>" iduser = "<?=$_SESSION['usuario']?>" name="btnCarro">
                  Añadir
                </button>
              </td>
              </tr>
            <from>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    </body>
  </html>
  
<?php
  function addCart($con,$iduser){
    var_dump($con);
    $sqlCarro="INSERT INTO `carrito`(`id`, `idusuario`) VALUES (NULL,$iduser)";
    $consulta=mysqli_query($con,$sqlCarro);
    var_dump($sqlCarro);

  }
}
  function buscador($con,$buscador){
    $sql2="SELECT * FROM `productos` where `id` = '$buscador' OR `nombre` = '$buscador'";
    //var_dump($sql2);
    $consulta=mysqli_query($con,$sql2);
    while($fila=$consulta->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$fila["id"]."</td>";
        echo "<td>".$fila["nombre"]."</td>";
        echo "<td>".$fila["cantidad"]."</td>";
        echo "<td>".$fila["precio"]."</td>";
        echo "<td>".$fila["descripcion"]."</td>";
        echo "<td>".'<i class="fa fa-cart-plus" aria-hidden="true" style="color:white;font-size:40px;padding-right:5%"></i>'."</td>";
        echo "</tr>";
    }
    $buscador = NULL;
  }
  
?>

<script type="text/javascript">
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

