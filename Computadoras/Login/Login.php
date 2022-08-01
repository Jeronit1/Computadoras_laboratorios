<?php
session_start();//se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
?>
<html>

<head>
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="/Computadoras/Style.css">
</head>

<body>
    <form action="" method="post">
        <p>Email:<input type="text" name="email" value="<?php
                                                        if (isset($email)) echo "$email"?>"/></p><!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Contraseña<input type="password" name="contraseña" value="" /></p>
        <p><input type="submit" name="submitIn" value="Iniciar sesion" /></p>
        <a href="/Computadoras/Registrarse/Registro.php"><input type="button" value="Registrarse"></a><!--boton de registrarse al hacer clic lo envia al registro-->
    </form>
    <?php
    include("Login-server.php");//Unir el codigo de server registro
    ?>
</body>

</html>
