<?php
session_start();
include("../Union-Server.php");
if (((empty($_SESSION["Email"])))) {
    header("location: ../Login/Login.php");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Base de datos Alumnos</title>
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>
        <img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre']  ?>
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) {
                            ?>
                                <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php">Ver computadoras</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <form>
        <?php
        $id = $_GET["ID"]; // Se obtiene en ID del objeto que se va a actualizar
        $Computadoras = "SELECT * FROM `pcs` WHERE ID = '$id'";
        $ComputadorasHistorial = "SELECT * FROM `historial pcs` WHERE ID = '$id'";
        $ResultadoComputadoras = mysqli_query($conex, $Computadoras);
        $Historial = mysqli_query($conex, $ComputadorasHistorial); //conexion para ver la tabla del usuario
        $mostrarPC = mysqli_fetch_array($ResultadoComputadoras); //imprime la tabla del usuario
        echo "<p>Computadora N°" . $mostrarPC['ID'] . "</p>";

        while ($mostrar = mysqli_fetch_array($Historial)) {
            if (empty($mostrar['Historial'])) {
                echo "<h1>No hay historial en esta pc</h1>";
            } else {
                echo "<p>" . $mostrar['Fecha'] . "</p>";
                echo "<p>" . $mostrar['Historial'] . "</p>";
            }
        }
    }

        ?>
        </form>
    </body>

    </html>