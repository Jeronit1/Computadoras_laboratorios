<?php
session_start(); //se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
?>
<html>

<head>
    <title>Formulario</title>
    <link rel="stylesheet" href="/Computadoras/style.css">
</head>

<body>
<img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre']  ?>
    <?php
    if ((($_SESSION["UserAdmin"] == 0))) { 
        header("location: /Computadoras/PaginaDeInicio.php");
    } else {
    ?>
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="/Computadoras/PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <li><a href="/Computadoras/Tablas PCs/Tabla-Computadoras.php">Ver Tabla de PCs</a></li>
                            <li><a href="/Computadoras/Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
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
                <td>Contraseña</td><!-- columna contraseña-->
                <td>Imagen</td><!-- columna contraseña-->
                <td>Administrador</td><!-- columna contraseña-->
                <td>Editar</td><!-- columna editar-->
            </tr>
            <?php
            $SQL = "SELECT * FROM `login-alumnos` WHERE 1"; //selecciono toda la base de datos para mostrarla
            $Resultado = mysqli_query($conex, $SQL); //se hace la conexion con toda la base de datos
            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime por pantalla toda la base de datos 
            ?>
                <tr>
                    <td><?php echo $mostrar['IDLogin'] ?></td><!-- muestra el id de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Nombre'] ?></td><!-- muestra el nombre de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Email'] ?></td><!-- muestra la email de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Contraseña'] ?></td><!-- muestra el contraseña de la base de datos en la tabla-->
                    <td><img src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen"></td><!-- muestra el contraseña de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Administrador'] ?></td><!-- muestra el contraseña de la base de datos en la tabla-->
                    <td><a href="/Computadoras/Tablas PCs/update/actualizar.php?IDLogin=<?php echo $mostrar["IDLogin"]; ?>">Editar</a>
                </tr>
        <?php
            }
        }
        mysqli_free_result($Resultado);
        ?>
        </table>
</body>

</html>