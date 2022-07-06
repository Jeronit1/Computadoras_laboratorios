<?php
@session_start();
session_destroy();//destruye la sesion lo que provoca que vuelva al login
header("Location: /Computadoras/Login/Login.php");
?>