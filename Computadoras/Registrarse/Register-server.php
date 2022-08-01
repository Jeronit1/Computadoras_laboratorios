<?php
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //incluye la union al servidor de mysql

if (isset($_POST['submitUp'])) {//toma los datos del formulario registro y lo almaceno en variables
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $contraseña2 = trim($_POST['contraseña2']);
}

if (isset($_POST['submitUp'])) {//toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
    if (empty($name)) {//empty = si esta vacio
        echo "<p class='error'>* Agregue su Nombre</p>"; //mensaje de error si el nombre esta vacio
    }
    if (empty($email)) {
        echo "<p class='error'>* Agregue su Email</p>";//mensaje de error si el mail esta vacio
    }
    if (empty($contraseña)) {
        echo "<p class='error'>* Ingrese una contraseña</p>";//mensaje de error si la contraseña esta vacio
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {//error si el mail es incorrecto si esta mal escrito
        echo "<p class='error'>* Su correo es incorrecto</p>";
    } else{
    if ($contraseña!=$contraseña2){//compara las contraseñas 
        echo "<p class='error'>* Confirme su contraseña</p>";
    } else {
    if (strlen($_POST['name']) > 1 && strlen($_POST['email']) > 1 && strlen($_POST['contraseña']) > 1) {//verifica que los campos no esten vacios
        $result= mysqli_query($conex, "SELECT * FROM `login-alumnos` WHERE Email='$email'"); //Guarda en resultado todos los mail que existan en la base de datos para compararlos y tirar error si ponen uno igual
        if(mysqli_num_rows($result)>0)  // Si es mayor a cero imprimimos que ya existe el usuario
        {
             echo "<p class='error'>Ya existe el Usuario</p>";
        }
        else
        {
        $Pedido = "INSERT INTO `login-alumnos`(`Nombre`, `Email`, `Contraseña`, `Confirmacion`) VALUES ('$name','$email','$contraseña','$contraseña2')";//Inserta todos los datos a la base de datos
        $Resultado = mysqli_query($conex, $Pedido);//verifica que los datos se hayan enviado correctamente en el if de abajo
        if ($Resultado) {//verifica que los datos se envien a la base de datos
            echo "<h>Te inscribiste a alumnos</h>";
            header("location: /Computadoras/Login/Login.php");//lo envia al login
        } else {
            echo "<h2>Ocurrio un error</h2>";//susede raramente este mensaje
        } }
    }}}
}

