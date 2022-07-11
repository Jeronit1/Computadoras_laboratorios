<?php
$conexion= mysqli_connect('localhost','root','','tp-php')//conexion al servidor
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="/Formulario-Alumnos/style.css">
</head>

<body>
    <form action="Proceso_delete.php" method="POST"><!-- Formulario que lleva al proceso de delete cuando se oprime el boton -->
    <table>
        <tr>
            <td>ID</td><!-- columna id-->
            <td>Nombre</td><!-- columna nombre-->
            <td>Edad</td><!-- columna edad-->
            <td>Email</td><!-- columna email-->
            <td>Telefono</td><!-- columna telefono-->
            <td>Fecha de registro</td><!-- columna fecha-->
            <td>Imagen</td><!-- columna imagen-->
            <td>ID_Login</td><!-- columna id_login-->
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        $id = $_GET["ID"];//se obtiene el id del usuario a eliminar
        $SQL= "SELECT * FROM `base de datos alumnos` WHERE ID = '$id'";//se selecciona el usuario con tal id
        $Resultado=mysqli_query($conexion, $SQL);// se hace la conexion
        while ($mostrar=mysqli_fetch_array($Resultado)) {//se imprime la tabla del usuario a eliminar
        ?>
        <tr>
        <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID"><!-- id oculto para guardar el id y poder hacer el proceso de delete no mostrar este input -->
            <td><?php echo $mostrar['ID'] ?></td><!-- se muestra el ID-->
            <td><?php echo $mostrar['Nombre'] ?></td><!-- se muestra el Nombre-->
            <td><?php echo $mostrar['Edad'] ?></td><!-- se muestra la edad-->
            <td><?php echo $mostrar['Email'] ?></td><!-- se muestra el mail-->
            <td><?php echo $mostrar['Telefono'] ?></td><!-- se muestra el telefono-->
            <td><?php echo $mostrar['Fecha de registro'] ?></td><!-- se muestra la fecha-->
            <td><?php echo $mostrar['Imagen'] ?></td><!-- se muestra la imagen(URL)-->
            <td><?php echo $mostrar['ID_Login'] ?></td><!-- se muestra el ID_Login-->
            <td> <input type="submit" value="Eliminar"></td><!-- boton que lleva al proceso de delete-->
        </tr>
        <?php
        } 
        ?>
    </table>
    </form>
</body>

</html>