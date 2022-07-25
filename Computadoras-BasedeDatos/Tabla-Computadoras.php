<?php
session_start();
$conexion= mysqli_connect('localhost','root','','tp5');//se hace la conexion a la base de datos de mysql
/////Variables de consultas/////
$where="";
$xLaboratorio=$_POST['xLaboratorio'];
$xProcesador=$_POST['xProcesador'];
$xRAM=$_POST['xRAM'];
///////Boton Buscar Filtros////
if(isset($_POST['buscar'])){
    if (empty($_POST['xLaboratorio']) && empty($_POST['xRAM'])){
        $where="where Procesador like '".$xProcesador."%'";
    }
    else if(empty($_POST['xLaboratorio']) && empty($_POST['xProcesador'])){
        $where="where RAM>'".$xRAM."'";
    }
    else if(empty($_POST['xRAM']) && empty($_POST['xProcesador'])){
        $where="where Laboratorio='".$xLaboratorio."'";
    }
    else if (empty($_POST['xLaboratorio'])){
        $where="where RAM>'".$xRAM."' and Procesador like '".$xProcesador."%'";
    }
    else if (empty($_POST['xProcesador'])){
        $where="where RAM>'".$xRAM."' and Laboratorio='".$xLaboratorio."'";
    }
    else{
        $where="where Laboratorio='".$xLaboratorio."' and Procesador like '".$xProcesador."%'";
    }
}
////Consulta a la base de datos/////
$Laboratorios = "SELECT * FROM `laboratorios`";
$PCs= "SELECT * FROM `pcs` $where ";
$resPCs=$conexion->query($PCs);
$resLaboratorio=$conexion->query($Laboratorios);
////Ver si el usuario es administrador///
if ((($_SESSION["UserAdmin"]==0))) {//si el usuario no es administrador lo devuelve al formulario
            header("location: /Computadoras/formulario.php");
        } else {
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
    <a href="/Computadoras/Login/logout.php"><input type="button" value="Cerrar sesion" Cerrar Sesión></a><!--boton que provoca que la sesion se cierre-->
    <a href="/Computadoras/Formulario.php"><input type="button" value="Volver" Volver></a><!--boton que provoca que la sesion se cierre-->
    <br></br>
    <form method="POST" class="Filtros">
        <select name="xLaboratorio">
            <option value="">Laboratorios</option>
            <?php
                while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH))
                {
                    echo '<option value="'.$RegistroLaboratorios['Laboratorio'].'">'.$RegistroLaboratorios['Laboratorio'].'</option>';
                }
            ?>
        </select>
        <input type="text" placeholder="Procesador..." name="xProcesador">
        <input type="number" name="xRAM" placeholder="PC con RAM mayor a..." />
        Ver pc con zocalos Libres<input type="checkbox" name="Zocalos_Libres?" />
        <button name="buscar" type="submit">Buscar</button>
    </form>
    <br></br>
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
            <td>Zocalos Libres</td>
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        while ($mostrar = $resPCs->fetch_array(MYSQLI_BOTH)) {//imprime por pantalla toda la base de datos 
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
            <td><?php echo $mostrar['Zocalos_Libres'] ?></td>
            <td><a href="/Computadoras-BasedeDatos/update/actualizar.php?ID=<?php echo $mostrar["ID"];?>">Editar/</a>
            <a href="/Computadoras-BasedeDatos/delete/eliminar.php?ID=<?php echo $mostrar["ID"];?>">Eliminar</a><!-- muestra los enlaces para editar o eliminar-->
            </td>
        </tr>
        <?php
        } }
        ?>
    </table>
    <button onclick="window.location.href = '/Computadoras/Formulario.php'">Anexar</button><!-- boton que lleva a anexar un nuevo usuario-->

</body>

</html>