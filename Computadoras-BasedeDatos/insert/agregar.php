<!DOCTYPE html>
<html>

<head>
    <title>Agregar nuevo</title>
    <link rel="stylesheet" href="/Formulario-Alumnos/style.css">

<?php
$conexion= mysqli_connect('localhost','root','','tp-php')//conexion a la base de datos
?>
</head>
<body>
<form action="Proceso_insert.php" method="post"><!-- Formulario que lleva al proceso de insert cuando se oprime el boton -->
<table>
        <tr>
            <td>Nombre</td><!-- columna nombre-->
            <td>Edad</td><!-- columna edad-->
            <td>Email</td><!-- columna email-->
            <td>Telefono</td><!-- columna telefono-->
            <td>Fecha de registro</td><!-- columna fecha-->
            <td>Imagen</td><!-- columna imagen-->
            <td>ID_Login</td><!-- columna ID_Login-->
            <td>Editar</td><!-- columna editar-->
        </tr>
        <?php
        $SQL= "SELECT * FROM `base de datos alumnos` WHERE 1 order by id desc";//se selecciona de la base de datos el ultimo id para incrementarlo y hacerlo auto incremental
        $Resultado=mysqli_query($conexion,$SQL);//se hace la conexion 
        $mostrar=mysqli_fetch_array($Resultado)//se obtiene el ultimo id para hacerlo auto incremental
        ?>
        <tr>
        <input type="hidden" value="<?php echo $mostrar['ID']+1 ?>" name="ID" ><!-- id oculto se asigna automaticamente de manera auto incremental por el +1 -->
            <td><input type="text" value="" name="Nombre" required minlength="4"></td><!-- nombre que se le da al usuario -->
            <td><input type="text" value="" name="Edad" required minlength="1"></td><!-- edad que se le da al usuario -->
            <td><input type="text" value="" name="Email" required minlength="5"></td><!-- email que se le da al usuario -->
            <td><input type="text" value="" name="Telefono" required minlength="6"></td><!-- telefono que se le da al usuario -->
            <td><input type="text" value=""name="Fechaderegistro" required minlength="8"></td><!-- fecha de ingreso que se le da al usuario -->
            <td><input type="text" value="" name="Imagen" required minlength="1"></td><!-- imagen (URL) que se le da al usuario -->
            <td><input type="text" value="" name="ID_Login" required minlength="1"></td><!-- ID_Login que se le da al usuario -->
            <td><input type="submit" value="Agregar"></td><!-- Boton que lleva al proceso de insert -->
            </tr>
        <?php
         mysqli_free_result($Resultado);
        ?>
    </table>
    </form>
    </body>