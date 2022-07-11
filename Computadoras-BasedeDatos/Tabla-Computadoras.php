<?php
session_start();
$conexion= mysqli_connect('localhost','root','','tp5')//se hace la conexion a la base de datos de mysql
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
<?php
if ((($_SESSION["UserAdmin"]==0))) {//si el usuario no es administrador lo devuelve al formulario
            header("location: /Computadoras/formulario.php");
        } else {
    ?>
    <a href="/Computadoras/Login/logout.php"><input type="button" value="Cerrar sesion" Cerrar Sesión></a><!--boton que provoca que la sesion se cierre-->
    <table>
        <tr> <!-- fila de la tabla-->
            <td>ID</td> <!-- columna id-->
            <td>Procesador</td><!-- columna nombre-->
            <td>RAM</td><!-- columna edad-->
            <td>MotherBoard</td><!-- columna email-->
            <td>Zocalos</td><!-- columna telefono-->
            <td>HDD</td><!-- columna fecha-->
            <td>Marca</td><!-- columna imagen (url)-->
            <td>Laboratorio</td><!-- columna id_login para saber quien se logeo-->
            <td>DIMMs</td><!-- columna editar-->
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        $SQL= "SELECT * FROM `pcs` WHERE 1";//selecciono toda la base de datos para mostrarla
        $Resultado=mysqli_query($conexion,$SQL);//se hace la conexion con toda la base de datos
        while ($mostrar=mysqli_fetch_array($Resultado)) {//imprime por pantalla toda la base de datos 
        ?>
        <tr>
        <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID"><!-- ID oculto para ocupar en eliminar y editar(con el id se sabe cual se selecciono para hacer los cambios) -->
            <td><?php echo $mostrar['ID'] ?></td><!-- muestra el id de la base de datos en la tabla-->
            <td><?php echo $mostrar['Procesador'] ?></td><!-- muestra el id de la base de datos en la tabla-->
            <td><?php echo $mostrar['RAM'] ?></td><!-- muestra el nombre de la base de datos en la tabla-->
            <td><?php echo $mostrar['MotherBoard'] ?></td><!-- muestra la edad de la base de datos en la tabla-->
            <td><?php echo $mostrar['Zocalos'] ?></td><!-- muestra el mail de la base de datos en la tabla-->
            <td><?php echo $mostrar['HDD'] ?></td><!-- muestra el telefono de la base de datos en la tabla-->
            <td><?php echo $mostrar['Marca'] ?></td><!-- muestra la fecha de la base de datos en la tabla-->
            <td></a><?php  echo $mostrar['Laboratorio'] ?></td><!-- muestra la imagen de la base de datos en la tabla(URL)-->
            <td><?php echo $mostrar['DIMMs'] ?></td><!-- muestra el id_login de la base de datos en la tabla-->
            <td><a href="/Formulario-Alumnos/update/actualizar.php?ID=<?php echo $mostrar["ID"];?>">Editar/</a>
            <a href="/Formulario-Alumnos/delete/eliminar.php?ID=<?php echo $mostrar["ID"];?>">Eliminar</a><!-- muestra los enlaces para editar o eliminar-->
            </td>
        </tr>
        <?php
        } }mysqli_free_result($Resultado);
        ?>
    </table>
    <button onclick="window.location.href = '/Formulario-Alumnos/insert/Agregar.php'">Anexar</button><!-- boton que lleva a anexar un nuevo usuario-->
</body>

</html>