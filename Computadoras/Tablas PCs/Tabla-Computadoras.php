<?php
session_start(); // Permite usar variables globales
include("../Union-Server.php"); //Union con la base de datos
?>
<!-- Muestra imagen, nombre y rango -->
<img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                                        if ($_SESSION['UserAdmin'] == 0) {
                                                                                            echo "<h5>Usuario</h5>";
                                                                                        } else {
                                                                                            echo "<h5>Administrador</h5>";
                                                                                        }  ?>
<!-- DESPLEGABLE -->
<header>
    <nav>
        <ul id="menu">
            <li><a href="../PaginaDeInicio.php">Inicio</a>
                <ul>
                    <?php if ($_SESSION["UserAdmin"]) { //Si el usuario es administrador se muestra ver usuarios
                    ?>
                        <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                    <?php } ?>
                    <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                    <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<br></br>
<?php
/////Variables de consultas/////
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
///////Filtros Funcion////
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

//si el usuario no se logeo es explusado
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
        <br><br>
        <!--Seccion de filtros -->
        <section>
            <form method="POST" class="Filtros">
                <!-- Muestro los laboratorios-->
                <select name="xLaboratorio">
                    <option value="">Laboratorios</option>
                    <?php
                    while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH)) {
                        echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                    }
                    ?>
                </select>
                <!--Procesador, ram y zocalos libres-->
                <input type="text" placeholder="Procesador..." value="" name="xProcesador">
                <input type="number" name="xRAM" placeholder="PC con RAM mayor a..." />
                Ver pc con zocalos Libres<input type="checkbox" name="Zocalos_Libres?" value="1" />
                <!-- Boton de busqueda -->
                <button name="buscar" type="submit">Buscar</button>
            </form>

            <br></br>
            <?php
            //Mensaje de error si no se encontro los datos que se insertaron en el filtro
            if (mysqli_num_rows($resPCs) == 0) {
                $mensaje = "<h1>No se encontraron registros con esas busquedas</h1>";
            } else {
            ?>
                <table>
                    <tr>
                        <!-- fila de la tabla-->
                        <td>ID</td> <!-- columna id-->
                        <td>Procesador</td>
                        <td>RAM</td>
                        <td>MotherBoard</td>
                        <td>Zocalos</td>
                        <td>HDD</td>
                        <td>Marca</td>
                        <td>Laboratorio</td>
                        <td>DIMMs</td>
                        <td>Zocalos Libres</td>
                        <td>PS/2</td>
                        <td>Administrador</td>
                        <?php if ($_SESSION["UserAdmin"]) { //Si el usuario es admin puede editar
                        ?>
                            <td>Editar/Historial</td><!-- columna editar-->
                    </tr>
                <?php
                        } //imprime por pantalla las pcs 
                        while ($mostrar = $resPCs->fetch_array(MYSQLI_BOTH)) {
                ?>
                    <tr>
                        <!-- ID oculto para ocupar en eliminar y editar(con el id se sabe cual se selecciono para hacer los cambios) -->
                        <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID">
                        <td><?php echo $mostrar['ID'] ?></td><!-- muestra el id de la base de datos en la tabla-->
                        <td><?php echo $mostrar['Procesador'] ?></td>
                        <td><?php echo $mostrar['RAM'] ?></td>
                        <td><?php echo $mostrar['MotherBoard'] ?></td>
                        <td><?php echo $mostrar['Zocalos'] ?></td>
                        <td><?php echo $mostrar['HDD'] ?></td>
                        <td><?php echo $mostrar['Marca'] ?></td>
                        <td></a><?php echo $mostrar['Laboratorio'] ?></td>
                        <td><?php echo $mostrar['DIMMs'] ?></td>
                        <td><?php echo $mostrar['Zocalos_Libres'] ?></td>
                        <td><?php echo $mostrar['PS/2'] ?></td>
                        <td><?php echo $mostrar['Administrador'] ?></td>
                        <?php if ($_SESSION["UserAdmin"]) { // si es administrador puede editar y ver el historial
                        ?>
                            <td><a href="../Tablas PCs/update/actualizar.php?ID=<?php echo $mostrar["ID"]; ?>">Editar/</a>
                                <a href="../Tablas PCs/Historial_PCs.php?ID=<?php echo $mostrar["ID"]; ?>">Historial</a>
                            </td>
                    </tr>
        <?php
                            }
                        }
                    }
        ?>
                </table>
                <?php //Mensaje de error
                if (!empty($mensaje)) {
                    echo $mensaje;
                }
                ?>
                <br>
                <?php if ($_SESSION["UserAdmin"]) { //Si es admin puede agregar
                ?>
                    <button class="botonAnexar" onclick="window.location.href = '../Agregar PCs/Formulario.php'">Anexar</button><!-- boton que lleva a anexar un nuevo usuario-->
            <?php
                }
            }
            ?>
        </section>
    </body>

    </html>