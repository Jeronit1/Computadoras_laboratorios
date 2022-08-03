<?php session_start(); 
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //Unir el codigo del server-form?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="/Computadoras/Style.css">
</head>
<body>
<?php
    if (((empty($_SESSION["Email"])))) { //si el usuario no es administrador lo devuelve al formulario
        header("location: /Computadoras/Login/Login.php");
    } else {?>
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
            <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
        </ul>
        </li>
        </ul>
        </nav>
    </header>
    <br></br>
    <form action="/Computadoras/Perfil/Editar_Perfil.php" method="POST" enctype="multipart/form-data">
    <?php
        $SQL= "SELECT * FROM `login-alumnos` WHERE IDLogin = '".$_SESSION["IDLogin"]."'";//se selecciona atraves del id para que muestre el usuario a actualizar
        $Resultado=mysqli_query($conex, $SQL);//conexion para ver la tabla del usuario
        while ($mostrar=mysqli_fetch_array($Resultado)) {//imprime la tabla del usuario
        ?>
            <img src="<?php echo $mostrar['Imagen'] ?>" alt="imagen">
            <p>Nombre: <?php echo $mostrar['Nombre'] ?></p>
            <p>Email: <?php echo $mostrar['Email'] ?></p>
            <p>Contraseña: <?php echo $mostrar['Contraseña'] ?></p>
        <input type="submit" value="Editar"><!-- Boton de actualizar que lleva al proceso_update -->
        <?php
        }}
        ?>
    </form>
</body>
</html>