<?php
session_start();
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
if (((empty($_SESSION["Email"])))) { //si el usuario no es administrador lo devuelve al formulario
    header("location: /Computadoras/Login/Login.php");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Base de datos Alumnos</title>
        <link rel="stylesheet" href="/Computadoras/style.css">
    </head>

    <body>
    <img src="<?php echo str_replace("./", "../../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre']  ?>
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="/Computadoras/PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) {
                            ?>
                                <li><a href="/Computadoras/Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="/Computadoras/Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="/Computadoras/Tablas PCs/Tabla-Computadoras.php">Ver computadoras</a></li>
                            <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <form action="" method="POST">
            <!--formulario que lleva al proceso de update cuando se oprime el boton -->
            <?php
            $id = $_GET["ID"]; // Se obtiene en ID del objeto que se va a actualizar
            $SQL = "SELECT * FROM `pcs` WHERE ID = '$id'"; //se selecciona atraves del id para que muestre el usuario a actualizar
            $Resultado = mysqli_query($conex, $SQL); //conexion para ver la tabla del usuario
            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime la tabla del usuario
            ?>
                <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID" required minlength="1">
                <!--id oculto para hacer el proceso de update no mostrar -->
                <p>Procesador:<input type="text" name="Procesador" value="<?php echo $mostrar['Procesador'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Memoria RAM:<input type="number" name="RAM" value="<?php echo $mostrar['RAM'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>MotherBoard:<input type="text" name="MotherBoard" value="<?php echo $mostrar['MotherBoard'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Nro, #Zocalos de Ram<input type="number" name="Zocalos" value="<?php echo $mostrar['Zocalos'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Disco:<input type="text" name="HDD" value="<?php echo $mostrar['HDD'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Marca:<input type="text" name="Marca" value="<?php echo $mostrar['Marca'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Seleccionar:<select name="Laboratorio">
                        <option value="Laboratorio 1">Laboratorio 1</option>
                        <option value="Laboratorio 2">Laboratorio 2</option>
                        <option value="Laboratorio 3">Laboratorio 3</option>
                    </select></p>
                <p>DIMMs:<input type="text" name="DIMMs" value="<?php echo $mostrar['DIMMs'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>Zocalos_Libres:<input type="text" name="Zocalos_Libres" value="<?php echo $mostrar['Zocalos_Libres'] ?>" /></p>
                <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
                <p>PS/2:<input type="checkbox" name="PS2" value="1" /></p>
                <p>Administrador:<input type="text" name="Administrador" value="<?php echo $mostrar['Administrador'] ?>" /></p>
                <input type="submit" value="Actualizar" name="submitUpdate"> <input type="submit" value="Eliminar" name="submitDelete"><!-- Boton de actualizar que lleva al proceso_update -->
        <?php
                include("C:/xampp/htdocs/Computadoras/Tablas PCs/update/Proceso_update.php");
            }
        }
        ?>
        </form>
    </body>

    </html>