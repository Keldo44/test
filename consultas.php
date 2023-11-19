<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!DOCTYPE html>
<html>

<head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     <head>

     <body>
          <script type="text/javascript">
               function error() {
                    swal({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Login erróneo!',
                         dangerMode: true,
                    }).then((willDelete) => {
                         if (willDelete) {
                              swal("Redirigiendo...", {
                                   icon: "success",
                              });
                              window.location.href = "Login.php";
                         }
                    });
               }

               function addCart() {
                    swal({
                         icon: 'success',
                         title: 'Added',
                         text: 'Se ha sumado su producto al carrito!',
                         dangerMode: true,
                    }).then((willDelete) => {
                         if (willDelete) {
                              swal("Redirigiendo...", {
                                   icon: "success",
                              });
                              window.location.href = "leerProductos.php";
                         }
                    });
               }
          </script>
          
     </body>
     
</html>


<?php
session_start();

if (isset($_SESSION["usuario"])){
    $iduser = $_SESSION["usuario"];
}

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
}

if (isset($_GET['precio'])) {
    $precio = $_GET['precio'];
}

if (isset($_GET['cantidad'])) {
    $cantidad = $_GET['cantidad'];
}

if (isset($_GET['descripcion'])) {
    $descripcion = $_GET['descripcion'];
}

if (isset($_GET['usuario'])) {
    $n_usuario = $_GET['usuario'];
}

if (isset($_GET['pass'])) {
    $pass = $_GET['pass'];
}
if(isset($_GET['admin'])){
     $admin = $_GET['admin'];     
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

if (isset($_GET['apellidos'])) {
    $apellidos = $_GET['apellidos'];
}


$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "daw2";

$con = mysqli_connect($servidor, $usuario, $password, $bd);



if (!$con) {
     die("No se ha podido realizar la conexión_" . mysqli_connect_error() . "<br>");
} else {

     if (isset($_GET['updateBtn'])) {

          mysqli_set_charset($con, "utf8");
          $items="";
          if($nombre){$items = $items.", `nombre`='$nombre' ";}
          if($precio){$items = $items.", `precio` = $precio ";}
          if($cantidad){$items = $items.", `cantidad` = $cantidad ";}
          if($descripcion){$items = $items.", `id_category` = $descripcion ";}
          $items = substr($items, 1);
          $sql = "UPDATE `productos` SET $items WHERE `id` = $id";
          var_dump($sql);
          $consulta = mysqli_query($con, $sql);
          sleep(2);
          header('Location: main.php');
          exit();

     } elseif (isset($_GET['insertBtn'])) {

          mysqli_set_charset($con, "utf8");
          $sql = "INSERT INTO `productos`(`id`, `nombre`, `precio`, `cantidad`, `id_category`) 
                VALUES (NULL,'$nombre',$precio,$cantidad,$descripcion)";
          $consulta = mysqli_query($con, $sql);
          sleep(2);
          header('Location: main.php');
          exit();

     } elseif (isset($_GET['deleteBtn'])) {

          mysqli_set_charset($con, "utf8");
          $sql = "DELETE FROM `productos` WHERE `id` = '$id'";
          $consulta = mysqli_query($con, $sql);
          sleep(2);
          header('Location: main.php');
          exit();

     } elseif (isset($_GET['loginBtn'])) {

          $sql2 = "SELECT * FROM `usuarios`";
          $consulta = mysqli_query($con, $sql2);
          while ($fila = $consulta->fetch_assoc()) {
               $contraseñaEncriptada = sha1($pass);
               if ($fila['usuario'] == $n_usuario && $fila['pass'] == $contraseñaEncriptada) {
                    $_SESSION["id"] = $fila['id'];
                    $_SESSION["usuario"] = $fila['usuario'];
                    $_SESSION["admin"] = $fila['admin'];
                    if ($_SESSION["admin"] == 1) {
                         sleep(2);
                         header('Location: main.php');
                         exit();
                    } else {
                         sleep(2);
                         header('Location: leerProductos.php');
                         exit();
                    }

               } else {
                    echo "<script>";
                    echo "error(event);";
                    echo "</script>";
               }
          }

     } elseif (isset($_GET['registrarseBtn'])) {
          $contraseñaEncriptada = sha1($pass);
          mysqli_set_charset($con, "utf8");
          $sql = "INSERT INTO `usuarios`(`id`, `usuario`, `pass`, `admin`, `nombre`,`apellidos`,`email`) 
                VALUES (NULL,'$n_usuario','$contraseñaEncriptada',0,'$nombre','$apellidos','$email')";
          $consulta = mysqli_query($con, $sql);
          sleep(2);
          header('Location: login.php');
          exit();
     } elseif (isset($_GET['btnCarro'])) {
          $sqlVerificacion = "SELECT * FROM `carrito` WHERE id = '" . $_GET['btnCarro'] . "' AND idusuario = '" . $_SESSION['id'] ."'";
          $consultaVerificacion = mysqli_query($con, $sqlVerificacion);

          if (mysqli_num_rows($consultaVerificacion) > 0) {
               // El producto ya existe en el carrito, por lo que aumentamos la cantidad
               $producto = mysqli_fetch_assoc($consultaVerificacion);
               $cantidadNueva = $producto['cant'] + 1;

               $sqlActualizacion = "UPDATE `carrito` SET cant = '" . $cantidadNueva . "' WHERE id = '" . $_GET['btnCarro'] . "' AND idusuario = '" . $_SESSION['id'] . "'";
               $consultaActualizacion = mysqli_query($con, $sqlActualizacion);
          } else {
               // El producto no existe en el carrito, por lo que lo insertamos
               $sqlCarro = "INSERT INTO `carrito` (`id`, `idusuario`, cant) VALUES ('" . $_GET['btnCarro'] . "', '" . $_SESSION['id'] . "', 1)";
               $consultaCarro = mysqli_query($con, $sqlCarro);
          }
          echo "<script>";
          echo "addCart(event);";
          echo "</script>";
     } elseif (isset($_GET['updateUserBtn'])) {
          
          mysqli_set_charset($con, "utf8");
          $items="";
          if($n_usuario){$items = $items.", `usuario`='$n_usuario' ";}
          if(isset($admin)){$items = $items.", `admin`= $admin";}
          if($nombre){$items = $items.", `nombre`='$nombre' ";}
          if($apellidos){$items = $items.", `apellidos` = '$apellidos' ";}
          if($pass){
               $pass = sha1($pass);
               $items = $items.", `pass` = '$pass' ";
          }
          if($email){$items = $items.", `email` = '$email' ";}
          $items = substr($items, 1);
          $sql = "UPDATE `usuarios` SET $items WHERE `id` = $id";
          var_dump($sql);
          $consulta = mysqli_query($con, $sql);
          
          sleep(2);
          header('Location: main.php');
          exit();

     } elseif (isset($_GET['createUserBtn'])) {
          
          mysqli_set_charset($con, "utf8");
          $pass = sha1($pass);
          $sql = "INSERT INTO `usuarios` (`usuario`, `admin`, `nombre`, `apellidos`, `pass`, `email`) 
          VALUES ('$n_usuario', $admin, '$nombre', '$apellidos', '$pass', '$email')";
          var_dump($sql);
          $consulta = mysqli_query($con, $sql);
          
          sleep(2);
          header('Location: main.php');
          exit();

     }  elseif (isset($_GET['borrarUserBtn'])) {
          mysqli_set_charset($con, "utf8");
          $sql = "DELETE FROM `usuarios` WHERE `id` = '$id'";
          $consulta = mysqli_query($con, $sql);
          sleep(2);
          header('Location: main.php');
          exit();
     }

}
?>