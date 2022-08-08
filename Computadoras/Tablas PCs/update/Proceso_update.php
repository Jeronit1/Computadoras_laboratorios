<script>
    function otraPagina() { //Funcion que manda el mensaje de que se actualizo correctamente
        var confirmar = confirm('Se actualizaron los cambios correctamente');
        if (confirmar) {

            window.location.href = '/computadoras/Tablas PCs/Tabla-Computadoras.php'

        } else {
            alert('hubo un error')
        }
    }
</script>
<?php
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
if (isset($_POST['submitDelete'])) {
    $id = $_POST['ID']; //Almaceno el ID en una variable
    $eliminar = "DELETE FROM `pcs` WHERE ID='$id'"; //se selecciona el usuario a eliminar
    $Resultado = mysqli_query($conex, $eliminar); //proceso que elimina el usuario
    if ($Resultado) { //tira el mensaje de todo bien y te regresa a la tabla_alumnos
        echo "<script>otraPagina();</script>";
    }
} else {
    if (isset($_POST['submitUpdate'])) {
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
        $Administrador = $_POST['Administrador']; //
    }

    if (isset($_POST['submitUpdate'])) { //toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error

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