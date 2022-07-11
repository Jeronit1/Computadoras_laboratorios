<script>function otraPagina(){//Funcion que manda el mensaje de que se actualizo correctamente
var confirmar = confirm('Se inserto el usuario correctamente');
if (confirmar){
  
  window.location.href = '/Formulario-Alumnos/Tabla_Alumnos.php'

}else {alert('hubo un error')}}</script>
<?php
$conexion= mysqli_connect('localhost','root','','tp-php');//conexion a la base de datos

$id = $_POST['ID'];//Almaceno el ID en una variable
$nombre = $_POST['Nombre'];//Almaceno el nombre en una variable
$edad = $_POST['Edad'];//Almaceno la edad en una variable
$Email = $_POST['Email'];//Almaceno el mail en una variable
$Telefono = $_POST['Telefono'];//Almaceno el telefono en una variable
$Fecha = $_POST['Fechaderegistro'];//Almaceno la fecha en una variable
$Imagen = $_POST['Imagen'];//Almaceno la imagen(URL) en una variable
$ID_Login = $_POST['ID_Login'];//Almaceno el ID_Login en una variable

//insert
$insertar = "INSERT INTO `base de datos alumnos`(`ID`, `Nombre`, `Edad`, `Email`, `Telefono`, `Fecha de registro`, `Imagen`, `ID_Login`) VALUES ('$id','$nombre','$edad','$Email','$Telefono','$Fecha','$Imagen',$ID_Login)";//se almacena en una variable para hacer el proceso de insert a la base de datos

$Resultado=mysqli_query($conexion,$insertar);//se inserta el usuario en la base de datos
if ($Resultado){//tira el mensaje de todo bien y te regresa a la tabla_alumnos
    echo "<script>otraPagina();</script>";
    
} 
?>