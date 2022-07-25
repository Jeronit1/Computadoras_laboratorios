<script>function otraPagina(){//Funcion que manda el mensaje de que se actualizo correctamente
var confirmar = confirm('Se actualizaron los cambios correctamente');
if (confirmar){
  
  window.location.href = '/computadoras-BaseDeDatos/Tabla-Computadoras.php'

}else {alert('hubo un error')}}</script>
<?php
$conexion= mysqli_connect('localhost','root','','tp5');//conexion a la base de datos

$id = $_POST['ID'];//Almaceno el ID en una variable
$Procesador = $_POST['Procesador'];//Almaceno el Nombre que se actualizo en una variable
$RAM = $_POST['RAM'];//Almaceno la edad que se actualizo en una variable
$MotherBoard = $_POST['MotherBoard'];//Almaceno el mail que se actualizo en una variable
$Zocalos = $_POST['Zocalos'];//Almaceno el telefono que se actualizo en una variable
$HDD= $_POST['HDD'];//Almaceno la fecha que se actualizo en una variable
$Marca = $_POST['Marca'];//Almaceno la imagen que se actualizo en una variable
$Laboratorio= $_POST['Laboratorio'];//Almaceno el id_login en una variable
$DIMMs= $_POST['DIMMs'];//Almaceno el id_login en una variable
$Zocalos_Libres= $_POST['Zocalos_Libres'];//Almaceno el id_login en una variable
//actualizar
$actualizar = "UPDATE `pcs` SET `ID`='$id',`Procesador`='$Procesador',`RAM`='$RAM',`MotherBoard`='$MotherBoard',`Zocalos`='$Zocalos',`HDD`='$HDD',`Marca`='$Marca',`Laboratorio`='$Laboratorio',`DIMMs`='$DIMMs',`Zocalos_Libres`='$Zocalos_Libres' WHERE ID='$id'";
$Resultado=mysqli_query($conexion,$actualizar);//conexion que hace el proceso de update
if ($Resultado){//si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
    echo "<script>otraPagina();</script>";
    
} 
?>