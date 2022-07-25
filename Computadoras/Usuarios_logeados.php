<?php
session_start();//se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
include("Union-Server.php");
?>
<html>

<head>
    <title>Formulario</title>
    <link rel="stylesheet" href="/Computadoras/style.css">
</head>
<body>
    <?php
if ((($_SESSION["UserAdmin"]==0))) {//si el usuario no es administrador lo devuelve al formulario
            header("location: /Computadoras/formulario.php");
        } else {
    ?>
<a href="/Computadoras/Login/logout.php"><input type="button" value="Cerrar sesion" Cerrar Sesión></a><!--boton que provoca que la sesion se cierre-->
<a href="/Computadoras/Formulario.php"><input type="button" value="Volver" Volver></a><!--boton que provoca que la sesion se cierre-->

<br>
<table>
        <tr> <!-- fila de la tabla-->
            <td>ID_Login</td> <!-- columna id-->
            <td>Nombre</td><!-- columna nombre-->
            <td>Email</td><!-- columna email-->
            <td>Contraseña</td><!-- columna contraseña-->
        </tr>
        <?php
        $SQL= "SELECT * FROM `login-alumnos` WHERE 1";//selecciono toda la base de datos para mostrarla
        $Resultado=mysqli_query($conex,$SQL);//se hace la conexion con toda la base de datos
        while ($mostrar=mysqli_fetch_array($Resultado)) {//imprime por pantalla toda la base de datos 
        ?>
        <tr>
            <td><?php echo $mostrar['IDLogin'] ?></td><!-- muestra el id de la base de datos en la tabla-->
            <td><?php echo $mostrar['Nombre'] ?></td><!-- muestra el nombre de la base de datos en la tabla-->
            <td><?php echo $mostrar['Email'] ?></td><!-- muestra la email de la base de datos en la tabla-->
            <td><?php echo $mostrar['Contraseña'] ?></td><!-- muestra el contraseña de la base de datos en la tabla-->
        </tr>
        <?php
        }} mysqli_free_result($Resultado);
        ?>
    </table>
</body>

</html>