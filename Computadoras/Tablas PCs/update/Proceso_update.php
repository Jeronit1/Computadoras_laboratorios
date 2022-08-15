<script>
    function otraPagina() { //Funcion que manda el mensaje de que se actualizo correctamente
        var confirmar = confirm('Se actualizaron los cambios correctamente');
        if (confirmar) {

            window.location.href = '../../Tablas PCs/Tabla-Computadoras.php'

        } else {
            alert('hubo un error')
        }
    }
</script>
<?php
if (isset($_POST['submitPerfil1'])) {

    $Nombre = $_POST['Nombre'];
    $Contraseña = $_POST['Contraseña'];
    if (empty($Nombre) || empty($Contraseña)) {
        echo "<p class='error'>Rellene todos los campos</p>"; //mensaje de error si el nombre esta vacio
    }
    if (strlen($_POST['Nombre']) > 1 && strlen($_POST['Contraseña']) > 0) {
        //////Imagen///////
        $Nombre_Imagen = $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
        if (empty($Nombre_Imagen)) {
            $actualizar = "UPDATE `login-alumnos` SET `Nombre`='$Nombre',`Contraseña`='$Contraseña', `Confirmacion`='$Contraseña'WHERE IDLogin='" . $_SESSION["IDLogin"] . "'";
        } else {
            $Nombre_Imagen = time() . $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
            // $Tipo_Imagen=$_FILES['Imagen'] ['type']; //se puede obtener el tipo de imagen
            //$Tamaño_Imagen=$_FILES['Imagen'] ['size'];//se puede obtener el tamaño original de la imagen
            $Carpeta_Destino = '../../intranet/uploads/'; //sirve para guardar las imagenes en intranet
            move_uploaded_file($_FILES['Imagen']['tmp_name'], $Carpeta_Destino . $Nombre_Imagen); //mueve la imagen subida a intranet
            //////// actualizar//////////////
            $actualizar = "UPDATE `login-alumnos` SET `Nombre`='$Nombre', `Imagen`='./intranet/uploads/$Nombre_Imagen',`Contraseña`='$Contraseña', `Confirmacion`='$Contraseña'WHERE IDLogin='" . $_SESSION["IDLogin"] . "'";
            $_SESSION["Imagen"] = "./intranet/uploads/$Nombre_Imagen";
        }
        $Resultado = mysqli_query($conex, $actualizar); //conexion que hace el proceso de update

        if ($Resultado) { //si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
            header("location: ../../Perfil/Perfil.php");
        };
    }
} else if (isset($_GET["IDLogin"])) {
    if (isset($_POST['submitUser'])) {
        $IDLogin = $_POST['IDLogin']; //Almaceno el ID en una variable
        $Nombre = $_POST['Nombre']; //Almaceno el ID en una variable
        $Email = $_POST['Email']; //Almaceno el ID en una variable
        $Contraseña = $_POST['Contraseña']; //Almaceno el ID en una variable
        $Administrador = $_POST['Administrador']; //Almaceno el ID en una variable
        if (empty($Nombre)) {
            echo "<p class='error'>* Agregue un nombre</p>"; //mensaje de error si el nombre esta vacio
        }
        if (empty($Email)) {
            echo "<p class='error'>* Agregue un Email</p>"; //mensaje de error si el nombre esta vacio
        }
        if (empty($Contraseña)) {
            echo "<p class='error'>* Agregue una Contraseña</p>"; //mensaje de error si el nombre esta vacio
        }
        //actualizar
        if (strlen($_POST['Nombre']) > 1 && strlen($_POST['Email']) > 0 && strlen($_POST['Contraseña']) > 1) { //verifica que los campos no esten vacios

            $actualizarUser = "UPDATE `login-alumnos` SET `IDLogin`='$IDLogin',`Nombre`='$Nombre',`Email`='$Email',`Contraseña`='$Contraseña',`Administrador`='$Administrador' WHERE IDLogin='$IDLogin'";
            $Resultado = mysqli_query($conex, $actualizarUser); //conexion que hace el proceso de update
            if ($Resultado) { //si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
                header("location: ../../Tablas PCs/Usuarios_logeados.php");
            };
        }
    }
} else {
    if (isset($_POST['submitDelete'])) {
     $id = $_POST['ID']; //Almaceno el ID en una variable
    $eliminar = "DELETE FROM `pcs` WHERE ID='$id'"; //se selecciona el usuario a eliminar
    $Resultado = mysqli_query($conex, $eliminar); //proceso que elimina el usuario
    if ($Resultado) { //tira el mensaje de todo bien y te regresa a la tabla_alumnos
        echo "<script>otraPagina();</script>";
    }} 
   else if (isset($_POST['submitUpdate'])) {
        $id = $_POST['ID']; //Almaceno el ID en una variable
        $Procesador = $_POST['Procesador']; //Almaceno el Nombre que se actualizo en una variable
        $RAM = $_POST['RAM']; //Almaceno la edad que se actualizo en una variable
        $MotherBoard = $_POST['MotherBoard']; //Almaceno el mail que se actualizo en una variable
        $Zocalos = $_POST['Zocalos']; //Almaceno el telefono que se actualizo en una variable
        $HDD = $_POST['HDD']; //Almaceno la fecha que se actualizo en una variable
        $Marca = $_POST['Marca']; //Almaceno la imagen que se actualizo en una variable
        $Laboratorio = $_POST['Laboratorio']; //Almaceno el id_login en una variable
        $DIMMs = $_POST['DIMMs']; //Almaceno el id_login en una variable
        $Zocalos_Libres = $_POST['Zocalos_Libres']; //Almaceno el id_login en una variable
        if (!empty($_POST['PS2'])) {
            $PS2 = 1;
        } else {
            $PS2 = 0;
        };
        $Administrador = $_POST['Administrador'];

        if (empty($Procesador)) {
            echo "<p class='error'>* Agregue un procesador</p>"; //mensaje de error si el nombre esta vacio
        }
        if (empty($RAM)) {
            echo "<p class='error'>* Agregue la cantidad de RAM</p>"; //mensaje de error si la edad esta vacio
        }
        if (empty($MotherBoard)) {
            echo "<p class='error'>* Agregue un MotherBoardl</p>"; //mensaje de error si el mail esta vacio
        }
        if (empty($Zocalos)) {
            echo "<p class='error'>* Agregue la cantidad de zocalos</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($HDD)) {
            echo "<p class='error'>* Agregue el HDD</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($Marca)) {
            echo "<p class='error'>* Agregue la Marca de PC</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($DIMMs)) {
            echo "<p class='error'>* Agregue el tipo de dimm</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($Administrador)) {
            echo "<p class='error'>* Agregue su nombre</p>"; //mensaje de error si el telefono esta vacio
        }
        //actualizar
        if (strlen($_POST['Procesador']) > 1 && strlen($_POST['RAM']) > 0 && strlen($_POST['MotherBoard']) > 1 &&  strlen($_POST['Zocalos']) > -1 && strlen($_POST['HDD']) > 1 && strlen($_POST['Marca']) > 0 && strlen($_POST['DIMMs']) > 1 && strlen($_POST['Zocalos_Libres']) > 0 && strlen($_POST['Administrador']) > 1) { //verifica que los campos no esten vacios
            $actualizar = "UPDATE `pcs` SET `ID`='$id',`Procesador`='$Procesador',`RAM`='$RAM',`MotherBoard`='$MotherBoard',`Zocalos`='$Zocalos',`HDD`='$HDD',`Marca`='$Marca',`Laboratorio`='$Laboratorio',`DIMMs`='$DIMMs',`Zocalos_Libres`='$Zocalos_Libres',`PS/2`='$PS2',`Administrador`='$Administrador' WHERE ID='$id'";
            $Resultado = mysqli_query($conex, $actualizar); //conexion que hace el proceso de update
            if ($Resultado) { //si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
                echo "<script>otraPagina();</script>";
            };
        }
    }
} 
?>