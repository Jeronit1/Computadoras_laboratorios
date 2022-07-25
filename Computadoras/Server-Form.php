<script>function otraPagina(){//da un mensaje cuando se inscribe correctamente
var confirmar = confirm('Se insterto correctamente');
if (confirmar){
  
  window.location.href = '/Computadoras/Formulario.php'

}else {alert('hubo un error')}}</script>
<?php
//include
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
//verifica que exista un mail y en caso de no existir lo manda al login(al cerrar sesion se destruye el mail lo que provoca que lo mande a login)
    if ((empty ($_SESSION["email"]))) {
            header("location: /Computadoras/Login/Login.php");
        } else {
        
if (isset($_POST['submit'])) {//toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
    if (empty($Procesador)) {
        echo "<p class='error'>* Agregue un procesador</p>";//mensaje de error si el nombre esta vacio
    }
    if (empty($RAM)) {
        echo "<p class='error'>* Agregue la cantidad de RAM</p>";//mensaje de error si la edad esta vacio
    }
    if (empty($MotherBoard)) {
        echo "<p class='error'>* Agregue un MotherBoardl</p>";//mensaje de error si el mail esta vacio
    }
    if (empty($Zocalos)) {
        echo "<p class='error'>* Agregue la cantidad de zocalos</p>";//mensaje de error si el telefono esta vacio
    }
    if (empty($HDD)) {
        echo "<p class='error'>* Agregue el HDD</p>";//mensaje de error si el telefono esta vacio
    }
    if (empty($Marca)) {
        echo "<p class='error'>* Agregue la Marca de PC</p>";//mensaje de error si el telefono esta vacio
    }
    if (empty($DIMMs)) {
        echo "<p class='error'>* Agregue el tipo de dimm</p>";//mensaje de error si el telefono esta vacio
    }
    if (empty($Zocalos_Libres)) {
        echo "<p class='error'>* Agregue cuantos zocalos libres quedan</p>";//mensaje de error si el telefono esta vacio
    }
    
    if (strlen($_POST['Procesador']) > 1 && strlen($_POST['RAM']) > 0 && strlen($_POST['MotherBoard']) > 1 &&  strlen($_POST['Zocalos']) > 0 && strlen($_POST['HDD']) > 1 && strlen($_POST['Marca']) > 0 && strlen($_POST['DIMMs']) > 1 && strlen($_POST['Zocalos_Libres']) > 0) {//verifica que los campos no esten vacios
       // $Pedido= "INSERT INTO `pcs`(`Procesador`, `RAM`, `MotherBoard`, `Zocalos`, `HDD`, `Marca`, `Laboratorio`, `DIMMs`) VALUES ('$Procesador','$RAM','$MotherBoard','$Zocalos','$HDD','$Marca','$Laboratorio','$DIMMs')"; //Inserta todos los datos a la base de datos
        $Pedidos= "INSERT INTO `pcs`(`Procesador`, `RAM`, `MotherBoard`, `Zocalos`, `HDD`, `Marca`, `Laboratorio`, `DIMMs`, `Zocalos_Libres`) VALUES ('$Procesador','$RAM','$MotherBoard','$Zocalos','$HDD','$Marca','$Laboratorio','$DIMMs','$Zocalos_Libres')";
        $Resultado = mysqli_query($conex, $Pedidos);//verifica que los datos se hayan enviado correctamente en el if de abajo
        if ($Resultado) {
          echo "<script>otraPagina();</script>";//mensaje de que se inscribio correctamente
        };
    }}
}
?>