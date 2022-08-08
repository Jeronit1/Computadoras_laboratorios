<?php
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //incluye la union al servidor de mysql

if (isset($_POST['submitUp'])) { //toma los datos del formulario registro y lo almaceno en variables
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $contraseña2 = trim($_POST['contraseña2']);
}

if (isset($_POST['submitUp'])) { //toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
    if (empty($name)) { //empty = si esta vacio
        echo "<p class='error'>* Agregue su Nombre</p>"; //mensaje de error si el nombre esta vacio
    }
    if (empty($email)) {
        echo "<p class='error'>* Agregue su Email</p>"; //mensaje de error si el mail esta vacio
    }
    if (empty($contraseña)) {
        echo "<p class='error'>* Ingrese una contraseña</p>"; //mensaje de error si la contraseña esta vacio
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //error si el mail es incorrecto si esta mal escrito
        echo "<p class='error'>* Su correo es incorrecto</p>";
    } else {
        if ($contraseña != $contraseña2) { //compara las contraseñas 
            echo "<p class='error'>* Confirme su contraseña</p>";
        } else {
            if (strlen($_POST['name']) > 1 && strlen($_POST['email']) > 1 && strlen($_POST['contraseña']) > 1) { //verifica que los campos no esten vacios
                ///////IMAGEN DE PERFIL/////
                $Nombre_Imagen = $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
                if (empty($Nombre_Imagen)) {
                    $result = mysqli_query($conex, "SELECT * FROM `login-alumnos` WHERE Email='$email'"); //Guarda en resultado todos los mail que existan en la base de datos para compararlos y tirar error si ponen uno igual
                    if (mysqli_num_rows($result) > 0)  // Si es mayor a cero imprimimos que ya existe el usuario
                    {
                        echo "<p class='error'>Ya existe el Usuario</p>";
                    } else {
                        $Imagen_Default = './intranet/uploads/Logo2345456.png'; //sirve para guardar las imagenes en intrane
                        $Pedido = "INSERT INTO `login-alumnos`(`Nombre`, `Email`, `Imagen`, `Contraseña`, `Confirmacion`) VALUES ('$name','$email','$Imagen_Default','$contraseña','$contraseña2')"; //Inserta todos los datos a la base de datos
                        $Resultado = mysqli_query($conex, $Pedido); //verifica que los datos se hayan enviado correctamente en el if de abajo
                        if ($Resultado) { //verifica que los datos se envien a la base de datos
                            echo "<h>Te inscribiste a alumnos</h>";
                            header("location: /Computadoras/Login/Login.php"); //lo envia al login
                        } else {
                            echo "<h2>Ocurrio un error</h2>"; //susede raramente este mensaje
                        }
                    }
                } else {
                    $Nombre_Imagen = time() . $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
                    // $Tipo_Imagen=$_FILES['Imagen'] ['type']; //se puede obtener el tipo de imagen
                    //$Tamaño_Imagen=$_FILES['Imagen'] ['size'];//se puede obtener el tamaño original de la imagen
                    $Carpeta_Destino = '../intranet/uploads/'; //sirve para guardar las imagenes en intranet
                    move_uploaded_file($_FILES['Imagen']['tmp_name'], $Carpeta_Destino . $Nombre_Imagen); //mueve la imagen subida a intranet
                    ///////CONEXION/////////////
                    $result = mysqli_query($conex, "SELECT * FROM `login-alumnos` WHERE Email='$email'"); //Guarda en resultado todos los mail que existan en la base de datos para compararlos y tirar error si ponen uno igual
                    if (mysqli_num_rows($result) > 0)  // Si es mayor a cero imprimimos que ya existe el usuario
                    {
                        echo "<p class='error'>Ya existe el Usuario</p>";
                    } else {
                        $Pedido = "INSERT INTO `login-alumnos`(`Nombre`, `Email`, `Imagen`, `Contraseña`, `Confirmacion`) VALUES ('$name','$email','./intranet/uploads/$Nombre_Imagen','$contraseña','$contraseña2')"; //Inserta todos los datos a la base de datos
                        $Resultado = mysqli_query($conex, $Pedido); //verifica que los datos se hayan enviado correctamente en el if de abajo
                        if ($Resultado) { //verifica que los datos se envien a la base de datos
                            echo "<h>Te inscribiste a alumnos</h>";
                            header("location: /Computadoras/Login/Login.php"); //lo envia al login
                        } else {
                            echo "<h2>Ocurrio un error</h2>"; //susede raramente este mensaje
                        }
                    }
                }
            }
        }
    }
}
