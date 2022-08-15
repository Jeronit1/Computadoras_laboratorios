<?php session_start();
include("../Union-Server.php"); //Unir el codigo del server-form
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php
    if (((empty($_SESSION["Email"])))) { //si el usuario no es administrador lo devuelve al formulario
        header("location: ../Login/Login.php");
    } else { ?>
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) {
                            ?>
                                <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php">Ver Tabla de PCs</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <br></br>
        <form action="../Tablas PCs/update/actualizar.php" method="POST" enctype="multipart/form-data">
            <?php
            $SQL = "SELECT * FROM `login-alumnos` WHERE IDLogin = '" . $_SESSION["IDLogin"] . "'"; //se selecciona atraves del id para que muestre el usuario a actualizar
            $Resultado = mysqli_query($conex, $SQL); //conexion para ver la tabla del usuario
            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime la tabla del usuario
            ?>
                <img src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen">
                <p>Nombre: <?php echo $mostrar['Nombre'] ?></p>
                <p>Email: <?php echo $mostrar['Email'] ?></p>
                <p>Contraseña: <?php echo $mostrar['Contraseña'] ?></p>
                <input type="submit" value="Editar" name="submitPerfil"><!-- Boton de actualizar que lleva al proceso_update -->
        <?php
            }
        }
        ?>
        </form>
</body>

</html>