<?php
$conexion= mysqli_connect('localhost','root','','tp5')//conexion al servidor
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="/COMPUTADORAS-BASEDEDATOS/style.css">
</head>

<body>
    <form action="Proceso_delete.php" method="POST"><!-- Formulario que lleva al proceso de delete cuando se oprime el boton -->
    <table>
        <tr>
            <td>ID</td><!-- columna id-->
            <td>Procesador</td><!-- columna nombre-->
            <td>RAM</td><!-- columna edad-->
            <td>MotherBoard</td><!-- columna email-->
            <td>Zocalos</td><!-- columna telefono-->
            <td>HDD</td><!-- columna fecha-->
            <td>Marca</td><!-- columna imagen-->
            <td>Laboratorio</td><!-- columna id_login-->
            <td>DIMMs</td>
            <td>Zocalos_Libres</td>
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        $id = $_GET["ID"];//se obtiene el id del usuario a eliminar
        $SQL= "SELECT * FROM `pcs` WHERE ID = '$id'";//se selecciona el usuario con tal id
        $Resultado=mysqli_query($conexion, $SQL);// se hace la conexion
        while ($mostrar=mysqli_fetch_array($Resultado)) {//se imprime la tabla del usuario a eliminar
        ?>
        <tr>
        <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID"><!-- id oculto para guardar el id y poder hacer el proceso de delete no mostrar este input -->
            <td><?php echo $mostrar['ID'] ?></td><!-- se muestra el ID-->
            <td><?php echo $mostrar['Procesador'] ?></td><!-- se muestra el Nombre-->
            <td><?php echo $mostrar['RAM'] ?></td><!-- se muestra la edad-->
            <td><?php echo $mostrar['MotherBoard'] ?></td><!-- se muestra el mail-->
            <td><?php echo $mostrar['Zocalos'] ?></td><!-- se muestra el telefono-->
            <td><?php echo $mostrar['HDD'] ?></td><!-- se muestra la fecha-->
            <td><?php echo $mostrar['Marca'] ?></td><!-- se muestra la imagen(URL)-->
            <td><?php echo $mostrar['Laboratorio'] ?></td><!-- se muestra el ID_Login-->
            <td><?php echo $mostrar['DIMMs'] ?></td>
            <td><?php echo $mostrar['Zocalos_Libres'] ?></td>
            <td> <input type="submit" value="Eliminar"></td><!-- boton que lleva al proceso de delete-->
        </tr>
        <?php
        } 
        ?>
    </table>
    </form>
</body>

</html>