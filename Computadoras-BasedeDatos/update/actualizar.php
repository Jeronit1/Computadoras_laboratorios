<?php
$conexion= mysqli_connect('localhost','root','','tp5')//se hace la conexion a la base de datos de mysql
?>
<!DOCTYPE html>
<html>

<head>
    <title>Base de datos Alumnos</title>
    <link rel="stylesheet" href="/Computadoras-BasedeDatos/style.css">
</head>

<body>
    <form action="Proceso_update.php" method="POST"><!--formulario que lleva al proceso de update cuando se oprime el boton -->
        <?php
        $id = $_GET["ID"];// Se obtiene en ID del objeto que se va a actualizar
        $SQL= "SELECT * FROM `pcs` WHERE ID = '$id'";//se selecciona atraves del id para que muestre el usuario a actualizar
        $Resultado=mysqli_query($conexion, $SQL);//conexion para ver la tabla del usuario
        while ($mostrar=mysqli_fetch_array($Resultado)) {//imprime la tabla del usuario
        ?>
            <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID" required minlength="1"><!--id oculto para hacer el proceso de update no mostrar -->
            <p>Procesador:<input type="text" name="Procesador" value="<?php echo $mostrar['Procesador'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Memoria RAM:<input type="number" name="RAM" value="<?php echo $mostrar['RAM'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>MotherBoard:<input type="text" name="MotherBoard" value="<?php echo $mostrar['MotherBoard'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Nro, #Zocalos de Ram<input type="number" name="Zocalos" value="<?php echo $mostrar['Zocalos'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Disco:<input type="text" name="HDD" value="<?php echo $mostrar['HDD'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Marca:<input type="text" name="Marca" value="<?php echo $mostrar['Marca'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Seleccionar:<select name="Laboratorio">
            <option value="Laboratorio 1">Laboratorio 1</option>
            <option value="Laboratorio 2">Laboratorio 2</option>
            <option value="Laboratorio 3">Laboratorio 3</option>
        </select></p>
        <p>DIMMs:<input type="text" name="DIMMs" value="<?php echo $mostrar['DIMMs'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina --> 
        <p>Zocalos_Libres:<input type="text" name="Zocalos_Libres" value="<?php echo $mostrar['Zocalos_Libres'] ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina --> 
        <input type="submit" value="Actualizar"><!-- Boton de actualizar que lleva al proceso_update -->
        <?php
        }
        ?>
    </table>
    </form>
</body>

</html>