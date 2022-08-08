<?php
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //incluye la union al servidor de mysql
if (isset($_POST['submitIn'])) { //toma los datos del formulario registro y lo almaceno en variables
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $_SESSION['email'] = "$email";
}

if (isset($_POST['submitIn'])) { //toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
    if (empty($email)) { //empty==si esta vacio
        echo "<p class='error'>* Agregue su Email</p>"; //mensaje de error si el mail esta vacio
    }
    if (empty($contraseña)) { //mensaje de error si la contraseña esta vacio
        echo "<p class='error'>* Ingrese una contraseña</p>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //error si el mail es incorrecto si esta mal escrito
        echo "<p class='error'>* Su correo es incorrecto</p>";
    } else {
        if (strlen($_POST['email']) > 1 && strlen($_POST['contraseña']) > 1) { //verifica que los campos no esten vacios
            $Pedido = "select * from `login-alumnos` where email = '" . $_POST["email"] . "' and contraseña = '" . $_POST["contraseña"] . "'"; //Inserta todos los datos a la base de datos
            $Resultado = mysqli_query($conex, $Pedido); //verifica que los datos se hayan enviado correctamente en el if de abajo
            if (($row = mysqli_fetch_array($Resultado))) { //le da un numero de login al usuario para identificarlo en la columna IDLogin
                //usuariologuado
                $_SESSION["IDLogin"] = $row["IDLogin"];
                $_SESSION["Nombre"] = $row["Nombre"];
                $_SESSION["UserAdmin"] = $row["administrador"];
                $_SESSION["Email"] = $row["Email"];
                $_SESSION["Imagen"] = $row["Imagen"];
                //if $_SESSION["UserAdmin"] != 1  no es administrador
                //header()
                if ($Resultado) { //verifica que los datos se envien a la base de datos
                    echo "<h>Ingresaste correctamente</h>";
                    header("location: /Computadoras/PaginaDeInicio.php"); //lo envia al login
                } else {
                    echo "<h2>Ocurrio un error</h2>";
                }
            } else {
                echo "<p class='error'>*Datos Incorrectos</p>"; //susede raramente este mensaje
                //no hay usuario
            }
        }
    }
}
