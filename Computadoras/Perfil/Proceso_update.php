<script>function otraPagina(){//Funcion que manda el mensaje de que se actualizo correctamente
var confirmar = confirm('Se actualizaron los cambios correctamente');
if (confirmar){
  
  window.location.href = '/computadoras/Perfil/Perfil.php'

}else {alert('hubo un error')}}</script>
<?php
session_start();
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //Unir el codigo del server-form
$Nombre = $_POST['Nombre'];
$Contraseña = $_POST['Contraseña'];
if (strlen($_POST['Nombre']) > 1 && strlen($_POST['Contraseña']) > 0){
//////// actualizar//////////////
$actualizar = "UPDATE `login-alumnos` SET `Nombre`='$Nombre',`Contraseña`='$Contraseña',`Confirmacion`='$Contraseña'WHERE IDLogin='".$_SESSION["IDLogin"]."'";
$Resultado=mysqli_query($conex,$actualizar);//conexion que hace el proceso de update
if ($Resultado){//si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
    echo "<script>otraPagina();</script>";
    
} } 
else {
  ?>
  <script>
  alert("Rellene todos los campos")
  window.location.href = '/computadoras/Perfil/Editar_Perfil.php'
</script>;
  <?php
}
?>