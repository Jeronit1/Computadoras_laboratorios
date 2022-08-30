<?php
session_start(); //se inicia la sesion que sirve para guardar variables globales 
include("../Union-Server.php");// Conexion a la base de datos
$pagina = $_GET['pagina'];
$productosPorPagina = 3;
# Necesitamos el conteo para saber cuántas páginas vamos a mostrar
$sentencia = $base_de_datos->query("SELECT count(IDLogin) AS conteo FROM `login-alumnos`");
$conteo = $sentencia->fetchObject()->conteo;
# Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
$paginas = ceil($conteo / $productosPorPagina);
$offset = ($pagina - 1) * $productosPorPagina;
$Alumnos = "SELECT * FROM `login-alumnos` WHERE 1 limit $productosPorPagina offset $offset";
?>
<html>

<head>
    <title>Formulario</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Muestra Imagen Nombre y Rango -->
<img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen">  <?php echo $_SESSION['Nombre']; if ($_SESSION['UserAdmin']==0){echo "<h5>Usuario</h5>";}else{echo "<h5>Administrador</h5>";}  ?>
    <?php
    if ((($_SESSION["UserAdmin"] == 0))) { //Si el usuario no es admin lo expulsa
        header("location: ../PaginaDeInicio.php");
    } else {
    ?>
    <!-- DESPLEGABLE -->
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver Tabla de PCs</a></li>
                            <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <br></br>
        <table>
            <tr>
                <!-- fila de la tabla-->
                <td>ID_Login</td> <!-- columna id-->
                <td>Nombre</td><!-- columna nombre-->
                <td>Email</td><!-- columna email-->
                <td>Contraseña</td>
                <td>Imagen</td>
                <td>Administrador</td>
                <td>Editar</td><!-- columna editar-->
            </tr>
            <?php
            $Resultado = mysqli_query($conex, $Alumnos); //se hace la conexion con toda la base de datos
            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime por pantalla toda la base de datos 
            ?>
                <tr>
                    <td><?php echo $mostrar['IDLogin'] ?></td>
                    <td><?php echo $mostrar['Nombre'] ?></td>
                    <td><?php echo $mostrar['Email'] ?></td>
                    <td><?php echo $mostrar['Contraseña'] ?></td>
                    <td><img src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen"></td>
                    <td><?php if ($mostrar['Administrador']==0){echo "Usuario";}else{echo "Administrador";}  ?></td>
                    <!-- Obtiene el Id a actualizar -->
                    <td><a href="../Tablas PCs/update/actualizar.php?IDLogin=<?php echo $mostrar["IDLogin"]; ?>">Editar</a>
                </tr>
        <?php
            }
        } 
        mysqli_free_result($Resultado);
        ?>
        </table>
        <ul class="pagination">
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a href="./Usuarios_logeados.php?buscar=1&pagina=<?php echo $pagina - 1 ?>">«
                        </a>
                    </li>
                <?php } ?>
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo "active" ?>">
                        <a href="./Usuarios_logeados.php?buscar=1&pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <?php if ($pagina < $paginas) { ?>
                    <li>
                        <a href="./Usuarios_logeados.php?buscar=1&pagina=<?php echo $pagina + 1 ?>">»
                        </a>
                    </li>
                <?php } ?>
            </ul>
</body>

</html>