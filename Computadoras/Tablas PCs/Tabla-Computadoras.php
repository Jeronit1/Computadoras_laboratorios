<?php
session_start();
include("C:/xampp/htdocs/Computadoras/Union-Server.php");
/////Variables de consultas/////
?>
<img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre']  ?>
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
                    <li><a href="/Computadoras/Perfil/Perfil.php">Perfil</a></li>
                    <li><a href="/Computadoras/Login/Logout.php">Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<br></br>
<?php
$where = "";
if (isset($_POST['xLaboratorio'])) {
    $xLaboratorio = $_POST['xLaboratorio'];
}
if (isset($_POST['xProcesador'])) {
    $xProcesador = $_POST['xProcesador'];
}
if (isset($_POST['xRAM'])) {
    $xRAM = $_POST['xRAM'];
}
///////Boton Buscar Filtros////
if (isset($_POST['buscar'])) {
    if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xLaboratorio']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['xRAM']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where Procesador like '" . $xProcesador . "%'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>" . $xRAM . "";
    } else if (empty($_POST['xRAM']) && empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xLaboratorio'])) {
        $where = "where Zocalos_Libres>'0' and  RAM>" . $xRAM . "";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and  Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xLaboratorio']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xLaboratorio'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%' and RAM>" . $xRAM . "";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%' and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['Zocalos_Libres?'])) {
        $where = "where Procesador like '" . $xProcesador . "%' and RAM>" . $xRAM . " and Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador'])) {
        $where = "where Zocalos_Libres>'0' and RAM>" . $xRAM . " and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>'" . $xRAM . "' and Procesador like '" . $xProcesador . "%'";
    } else if (empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>'" . $xRAM . "' and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['xRAM']) && !empty($_POST['Zocalos_Libres?']) && empty($_POST['xLaboratorio'])) {
        $where = "where Laboratorio='" . $xLaboratorio . "' and Procesador like '" . $xProcesador . "%'";
    } else {
        $where = "where Laboratorio='" . $xLaboratorio . "' and Procesador like '" . $xProcesador . "%' and RAM>'" . $xRAM . "' and Zocalos_Libres>'0'";
    }
}
////Consulta a la base de datos/////
$Laboratorios = "SELECT * FROM `laboratorios`";
$PCs = "SELECT * FROM `pcs` $where ";
$resPCs = $conex->query($PCs);
$resLaboratorio = $conex->query($Laboratorios);

if (mysqli_num_rows($resPCs) == 0) {
    $mensaje = "<h1>No se encontraron registros con esas busquedas</h1>";
}

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
        <section>
            <form method="POST" class="Filtros">
                <select name="xLaboratorio">
                    <option value="">Laboratorios</option>
                    <?php
                    while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH)) {
                        echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                    }
                    ?>
                </select>
                <input type="text" placeholder="Procesador..." value="" name="xProcesador">
                <input type="number" name="xRAM" placeholder="PC con RAM mayor a..." />
                Ver pc con zocalos Libres<input type="checkbox" name="Zocalos_Libres?" value="1" />
                <button name="buscar" type="submit">Buscar</button>
            </form>

            <br></br>

            <table>
                <tr>
                    <!-- fila de la tabla-->
                    <td>ID</td> <!-- columna id-->
                    <td>Procesador</td><!-- columna nombre-->
                    <td>RAM</td><!-- columna edad-->
                    <td>MotherBoard</td><!-- columna email-->
                    <td>Zocalos</td><!-- columna telefono-->
                    <td>HDD</td><!-- columna fecha-->
                    <td>Marca</td><!-- columna imagen (url)-->
                    <td>Laboratorio</td><!-- columna id_login para saber quien se logeo-->
                    <td>DIMMs</td><!-- columna editar-->
                    <td>Zocalos Libres</td>
                    <td>PS/2</td>
                    <td>Administrador</td>
                    <?php if ($_SESSION["UserAdmin"]) {
                    ?>
                        <td>Editar</td><!-- columna editar-->
                </tr>
            <?php
                    }
                    while ($mostrar = $resPCs->fetch_array(MYSQLI_BOTH)) { //imprime por pantalla toda la base de datos 
            ?>
                <tr>
                    <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID"><!-- ID oculto para ocupar en eliminar y editar(con el id se sabe cual se selecciono para hacer los cambios) -->
                    <td><?php echo $mostrar['ID'] ?></td><!-- muestra el id de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Procesador'] ?></td><!-- muestra el id de la base de datos en la tabla-->
                    <td><?php echo $mostrar['RAM'] ?></td><!-- muestra el nombre de la base de datos en la tabla-->
                    <td><?php echo $mostrar['MotherBoard'] ?></td><!-- muestra la edad de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Zocalos'] ?></td><!-- muestra el mail de la base de datos en la tabla-->
                    <td><?php echo $mostrar['HDD'] ?></td><!-- muestra el telefono de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Marca'] ?></td><!-- muestra la fecha de la base de datos en la tabla-->
                    <td></a><?php echo $mostrar['Laboratorio'] ?></td><!-- muestra la imagen de la base de datos en la tabla(URL)-->
                    <td><?php echo $mostrar['DIMMs'] ?></td><!-- muestra el id_login de la base de datos en la tabla-->
                    <td><?php echo $mostrar['Zocalos_Libres'] ?></td>
                    <td><?php echo $mostrar['PS/2'] ?></td>
                    <td><?php echo $mostrar['Administrador'] ?></td>
                    <?php if ($_SESSION["UserAdmin"]) {
                    ?>
                        <td><a href="/Computadoras/Tablas PCs/update/actualizar.php?ID=<?php echo $mostrar["ID"]; ?>">Editar/</a>
                            <a href="/Computadoras/Tablas PCs/delete/eliminar.php?ID=<?php echo $mostrar["ID"]; ?>">Eliminar</a><!-- muestra los enlaces para editar o eliminar-->
                        </td>
                </tr>
    <?php
                        }
                    }
                }
    ?>
            </table>
            <?php
            if (!empty($mensaje)) {
                echo $mensaje;
            }
            ?>
            <br>
            <?php if ($_SESSION["UserAdmin"]) {
            ?>
                <button class="botonAnexar" onclick="window.location.href = '/Computadoras/Agregar PCs/Formulario.php'">Anexar</button><!-- boton que lleva a anexar un nuevo usuario-->
            <?php
            }
            ?>
        </section>
    </body>

    </html>