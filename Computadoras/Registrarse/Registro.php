<html>

<head>
    <title>Registrarse</title>
    <link rel="stylesheet" href="/Computadoras/Style.css">
</head>

<body>
    <?php
    include("Register-server.php");//Unir el codigo de server registro
    if (isset($_POST['submitUp'])) {//toma los datos del formulario y lo almaceno en variables
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contraseña = trim($_POST['contraseña']);
        $contraseña2 = trim($_POST['contraseña2']);
    }
    ?>
    <form action="" method="post">  <!-- Formulario de registro -->
       
        <p>Nombre:<input type="text" name="name" value="<?php
                                                        if (isset($name)) echo "$name" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Email:<input type="text" name="email" value="<?php
                                                        if (isset($email)) echo "$email" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Contraseña:<input type="password" name="contraseña" value="<?php
                                                        if (isset($contraseña)) echo "$contraseña" ?>" /></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Confirmar Contraseña:<input type="password" name="contraseña2" value="" /></p>                                                                                           
        <p><input type="submit" name="submitUp" value="Registrarse" /></p>
    </form>
</body>