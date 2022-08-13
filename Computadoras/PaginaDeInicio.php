<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/Computadoras/style.css">
    <title>Inicio</title>
</head>

<body>
<img src="<?php echo $_SESSION['Imagen'] ?>" alt="imagen"> <?php echo $_SESSION['Nombre']  ?>
    <?php
    if (((empty($_SESSION["Email"])))) { //si el usuario no es administrador lo devuelve al formulario
        header("location: /Computadoras/Login/Login.php");
    } else { ?>
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="/Computadoras/PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) {
                            ?>
                                <li><a href="/Computadoras/Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="/Computadoras/Tablas PCs/Tabla-Computadoras.php">Ver Tabla de PCs</a></li>
                            <li><a href="/Computadoras/Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <br></br>
        <div class="ConteinerInicio">
            <?php
            echo "<h1>Bienvenido " . $_SESSION["Nombre"] . "</h1>"; ?>
            

            <a href="/Computadoras/Tablas PCs/Tabla-Computadoras.php"><input class="BotonInicio" type="button" value="Ver tabla de las PCs"></a> <?php
                                                                                                                                                }
                                                                                                                                                    ?>
        </div>
</body>

</html>