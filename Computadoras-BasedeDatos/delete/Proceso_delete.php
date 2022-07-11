<script>function otraPagina(){//Funcion que manda el mensaje de que se actualizo correctamente
var confirmar = confirm('Se borraron los datos correctamente');
if (confirmar){
  
  window.location.href = '/Formulario-Alumnos/Tabla_Alumnos.php'

}else {alert('hubo un error')}}</script>
<?php
$conexion= mysqli_connect('localhost','root','','tp-php');//conexion al servidor
$id = $_POST['ID'];//se obtiene el id del usuario a eliminar
$eliminar = "DELETE FROM `base de datos alumnos` WHERE ID='$id'";//se selecciona el usuario a eliminar
$Resultado=mysqli_query($conexion,$eliminar);//proceso que elimina el usuario
if ($Resultado){//tira el mensaje de todo bien y te regresa a la tabla_alumnos
    echo "<script>otraPagina();</script>";
} 
?>