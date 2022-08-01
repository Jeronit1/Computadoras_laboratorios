<?php
session_start(); //se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
include("C:/xampp/htdocs/Computadoras/Union-Server.php"); //Unir el codigo del server-form
$Laboratorios = "SELECT * FROM `laboratorios`";
$resLaboratorio = $conex->query($Laboratorios);
if (((empty($_SESSION["Email"])))) { //si el usuario no es administrador lo devuelve al formulario
    header("location: /Computadoras/Login/Login.php");
} else {
?>
<html>

<head>
    <title>Formulario para agregar una PC</title>
    <link rel="stylesheet" href="/Computadoras/Style.css">
</head>

<body>
    <?php
    if (isset($_POST['submit'])) { //toma los datos del formulario y lo almaceno en variables
        $Procesador = trim($_POST['Procesador']);
        $RAM = trim($_POST['RAM']);
        $MotherBoard = trim($_POST['MotherBoard']);
        $Zocalos = ($_POST['Zocalos']);
        $HDD = ($_POST['HDD']);
        $Marca = ($_POST['Marca']);
        $Laboratorio = ($_POST['Laboratorio']);
        $DIMMs = ($_POST['DIMMs']);
        $Zocalos_Libres = ($_POST['Zocalos_Libres']);
         if (!empty($_POST['PS2'])) {
        $PS2=1;  
        }
        else{
        $PS2=0;
        };
    }
    ?>
    <header>
        <nav>
        <ul id="menu">
        <li><a href="/Computadoras/PaginaDeInicio.php">Inicio</a>
        <ul>
            <?php if ($_SESSION["UserAdmin"]) { 
            ?>
            <li><a href="/Computadoras/Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
            <?php } ?>
            <li><a href="/Computadoras/Tablas PCs/Tabla-Computadoras.php">Ver Tabla de PCs</a></li>
            <li><a href="/Computadoras/Perfil/Perfil.php">Ver Perfil</a></li>
            <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
        </ul>
        </li>
        </ul>
        </nav>
    </header>
    
    <br></br>
    <h1>Agregar PC</h1>
    <form action="" method="POST">
        <p>Procesador:<input type="text" name="Procesador" value="<?php
                                                                    if (isset($Procesador)) echo "$Procesador" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Memoria RAM:<input type="number" name="RAM" value="<?php
                                                                if (isset($RAM)) echo "$RAM" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>MotherBoard:<input type="text" name="MotherBoard" value="<?php
                                                                    if (isset($MotherBoard)) echo "$MotherBoard" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Nro, #Zocalos de Ram<input type="number" name="Zocalos" value="<?php
                                                                            if (isset($Zocalos)) echo "$Zocalos" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Disco:<input type="text" name="HDD" value="<?php
                                                        if (isset($HDD)) echo "$HDD" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Marca:<input type="text" name="Marca" value="<?php
                                                        if (isset($Marca)) echo "$Marca" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Seleccionar:<select name="Laboratorio">
                <option value="">Laboratorios</option>
                <?php
                while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH)) {
                    echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                }
                ?>
            </select></p>
        <p>DIMMs:<input type="text" name="DIMMs" value="<?php
                                                        if (isset($DIMMs)) echo "$DIMMs" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Zocalos_Libres:<input type="text" name="Zocalos_Libres" value="<?php
                                                                            if (isset($Zocalos_Libres)) echo "$Zocalos_Libres" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>PS/2:<input type="checkbox" name="PS2" value="1" /></p>
        <p><input type="submit" name="submit" value="Enviar" /></p>
    </form>
    <?php
    include("C:/xampp/htdocs/Computadoras/Agregar PCs/Server-Form.php");//Unir el codigo del server-form
             } 
    ?>
</body>

</html>