<script>
  function otraPagina() { //Funcion que manda el mensaje de que se actualizo correctamente
    var confirmar = confirm('Se borraron los datos correctamente');
    if (confirmar) {

      window.location.href = '/Computadoras/Tablas PCs/Tabla-Computadoras.php'

    } else {
      alert('hubo un error')
    }
  }
</script>
<?php
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
$id = $_POST['ID']; //se obtiene el id del usuario a eliminar
$eliminar = "DELETE FROM `pcs` WHERE ID='$id'"; //se selecciona el usuario a eliminar
$Resultado = mysqli_query($conex, $eliminar); //proceso que elimina el usuario
if ($Resultado) { //tira el mensaje de todo bien y te regresa a la tabla_alumnos
  echo "<script>otraPagina();</script>";
}
?>