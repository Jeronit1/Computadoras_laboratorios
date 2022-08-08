<script>
  function otraPagina() { //Funcion que manda el mensaje de que se actualizo correctamente
    var confirmar = confirm('Se actualizaron los cambios correctamente');
    if (confirmar) {

      window.location.href = '../Perfil/Perfil.php'

    } else {
      alert('hubo un error')
    }
  }
</script>
<?php
session_start();
include("../Union-Server.php"); //Unir el codigo del server-form
$Nombre = $_POST['Nombre'];
$Contraseña = $_POST['Contraseña'];
if (strlen($_POST['Nombre']) > 1 && strlen($_POST['Contraseña']) > 0) {
  //////Imagen///////
  //print_r($_FILES);
  $Nombre_Imagen = $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
  if (empty($Nombre_Imagen)) {
    $actualizar = "UPDATE `login-alumnos` SET `Nombre`='$Nombre',`Contraseña`='$Contraseña', `Confirmacion`='$Contraseña'WHERE IDLogin='" . $_SESSION["IDLogin"] . "'";
  } else {
    $Nombre_Imagen = time() . $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
    // $Tipo_Imagen=$_FILES['Imagen'] ['type']; //se puede obtener el tipo de imagen
    //$Tamaño_Imagen=$_FILES['Imagen'] ['size'];//se puede obtener el tamaño original de la imagen
    $Carpeta_Destino = '../intranet/uploads/'; //sirve para guardar las imagenes en intranet
    move_uploaded_file($_FILES['Imagen']['tmp_name'], $Carpeta_Destino . $Nombre_Imagen); //mueve la imagen subida a intranet
    //////// actualizar//////////////
    $actualizar = "UPDATE `login-alumnos` SET `Nombre`='$Nombre', `Imagen`='./intranet/uploads/$Nombre_Imagen',`Contraseña`='$Contraseña', `Confirmacion`='$Contraseña'WHERE IDLogin='" . $_SESSION["IDLogin"] . "'";
    $_SESSION["Imagen"] = "./intranet/uploads/$Nombre_Imagen";
  }
  $Resultado = mysqli_query($conex, $actualizar); //conexion que hace el proceso de update

  if ($Resultado) { //si se importo bien los cambios da el mensaje de todo bien y te devuelve a la TABLA-ALUMNOS
    echo "<script>otraPagina();</script>";
  }
} else {
?>
  <script>
    alert("Rellene todos los campos")
    window.location.href = '../Perfil/Editar_Perfil.php'
  </script>;
<?php
}
?>