<?php
$conexion= mysqli_connect('localhost','root','','tp-php')//se hace la conexion a la base de datos de mysql
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="/Formulario-Alumnos/style.css">
</head>

<body>
    <form action="Proceso_update.php" method="POST"><!--formulario que lleva al proceso de update cuando se oprime el boton -->
    <table>
        <tr>
            <td>Nombre</td><!-- columna Nombre-->
            <td>Edad</td><!-- columna Edad-->
            <td>Email</td><!-- columna Email-->
            <td>Telefono</td><!-- columna Telefono-->
            <td>Fecha de registro</td><!-- columna Fecha-->
            <td>Imagen</td><!-- columna Imagen-->
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        $id = $_GET["ID"];// Se obtiene en ID del objeto que se va a actualizar
        $SQL= "SELECT * FROM `base de datos alumnos` WHERE ID = '$id'";//se selecciona atraves del id para que muestre el usuario a actualizar
        $Resultado=mysqli_query($conexion, $SQL);//conexion para ver la tabla del usuario
        while ($mostrar=mysqli_fetch_array($Resultado)) {//imprime la tabla del usuario
        ?>
        <tr>
            <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID" required minlength="1"><!--id oculto para hacer el proceso de update no mostrar -->
            <td><input type="text" value="<?php echo $mostrar['Nombre'] ?>" name="Nombre" required minlength="4"></td><!--Nombre del usuario actual que se puede modificar -->
            <td><input type="text" value="<?php echo $mostrar['Edad'] ?>" name="Edad" required minlength="1"></td><!--Edad del usuario actual que se puede modificar -->
            <td><input type="text" value="<?php echo $mostrar['Email'] ?>" name="Email" required minlength="5"></td><!--Email del usuario actual que se puede modificar -->
            <td><input type="text" value="<?php echo $mostrar['Telefono'] ?>" name="Telefono" required minlength="6"></td><!--Telefono del usuario actual que se puede modificar -->
            <td><input type="text" value="<?php echo $mostrar['Fecha de registro'] ?>"name="Fechaderegistro" required minlength="8"></td><!--Fecha del usuario actual que se puede modificar -->
            <td><input type="text" value="<?php echo $mostrar['Imagen'] ?>" name="Imagen" required minlength="1"></td><!--Imagen (URL) del usuario actual que se puede modificar -->
            <input type="hidden" value="<?php echo $mostrar['ID_Login'] ?>" name="ID_Login" required minlength="1"><!--ID_Login del usuario actual oculto este no se debe modificar -->
            <td> <input type="submit" value="Actualizar"></td><!-- Boton de actualizar que lleva al proceso_update -->
        </tr>
        <?php
        }
        ?>
    </table>
    </form>
</body>

</html>