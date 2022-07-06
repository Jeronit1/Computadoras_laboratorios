<?php
session_start();//se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
?>
<html>

<head>
    <title>Formulario</title>
    <link rel="stylesheet" href="/Computadoras/Style.css">
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {//toma los datos del formulario y lo almaceno en variables
        $Procesador = trim($_POST['Procesador']);
        $RAM = trim($_POST['RAM']);
        $MotherBoard = trim($_POST['MotherBoard']);
        $Zocalos = ($_POST['Zocalos']);
        $HDD = ($_POST['HDD']);
        $Marca = ($_POST['Marca']);
        $Laboratorio = ($_POST['Laboratorio']);
        $DIMMs = ($_POST['DIMMs']);
    }
    ?>
    <a href="/Computadoras/Login/logout.php"><input type="button" value="Cerrar sesion" Cerrar Sesión></a><!--boton que provoca que la sesion se cierre-->
   <?php if ($_SESSION["UserAdmin"]) {//si el usuario es el administrador = se ve el boton ver usuarios?>
    <a href="/Computadoras/Usuarios_logeados.php"><input type="button" value="Ver usuarios"></a><!--boton que lleva a la tabla de usuarios logeados-->
    <?php }?>
    <form action="" method="post" enctype="multipart/form-data">
        <p>Procesador:<input type="text" name="Procesador" value="<?php
                                                        if (isset($Procesador)) echo "$Procesador" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>RAM:<input type="text" name="RAM" value="<?php
                                                         if (isset($RAM)) echo "$RAM" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>MotherBoard:<input type="text" name="MotherBoard" value="<?php
                                                        if (isset($MotherBoard)) echo "$MotherBoard" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Nro, #Zocalos de Ram<input type="number" name="Zocalos" value="<?php
                                                            if (isset($Zocalos)) echo "$Zocalos" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Disco:<input type="text" name="HDD" value="<?php
                                                        if (isset($HDD)) echo "$HDD" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Marca:<input type="text" name="Marca" value="<?php
                                                        if (isset($Marca)) echo "$Marca" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Laboratorio:<input type="number" name="Laboratorio" value="<?php
                                                        if (isset($Laboratorio)) echo "$Laboratorio" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>DIMMs:<input type="text" name="DIMMs" value="<?php
                                                        if (isset($DIMMs)) echo "$DIMMs" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina --> 
        <p><input type="submit" name="submit" value="Enviar" /></p>
    </form>
    <?php
    include("Server-Form.php");//Unir el codigo del server-form
    ?>
</body>

</html>