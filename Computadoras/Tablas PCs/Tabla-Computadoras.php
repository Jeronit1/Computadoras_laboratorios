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
                        <li><a href="../Tablas PCs/Usuarios_logeados.php?pagina=1">Ver Usuarios</a></li>
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

$Zocalos_Libres = "";
$where = "";
$pagina = $_GET['pagina'];
if (isset($_POST['buscar']))
  $pagina = 1;
$productosPorPagina = 3;
# Necesitamos el conteo para saber cuántas páginas vamos a mostrar
$sentencia = $base_de_datos->query("SELECT count(id) AS conteo FROM pcs");
$conteo = $sentencia->fetchObject()->conteo;
# Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
$paginas = ceil($conteo / $productosPorPagina);
$offset = ($pagina - 1) * $productosPorPagina;
if (isset($_POST['xLaboratorio'])) {
    $xLaboratorio = $_POST['xLaboratorio'];
    $_SESSION['xLaboratorio'] = "$xLaboratorio";
}
if (isset($_POST['xProcesador'])) {
    $xProcesador = $_POST['xProcesador'];
    $_SESSION['xProcesador'] = "$xProcesador";
}
if (isset($_POST['xRAM'])) {
    $xRAM = $_POST['xRAM'];
    $_SESSION['xRAM'] = "$xRAM";
}
$Zocalos_Libres = 0;
if (isset($_POST['Zocalos_Libres?'])) {
    $Zocalos_Libres = $_POST['Zocalos_Libres?'];
    $_SESSION['Zocalos'] = "$Zocalos_Libres";
} else {
    if (isset($_POST['buscar']))
        $_SESSION['Zocalos'] = "$Zocalos_Libres";
}
if (isset($_SESSION['xLaboratorio']))
    $xLaboratorio = $_SESSION['xLaboratorio'];
if (isset($_SESSION['xRAM']))
    $xRAM = $_SESSION['xRAM'];
if (isset($_SESSION['xProcesador']))
    $xProcesador = $_SESSION['xProcesador'];
if (isset($_SESSION['Zocalos']))
    $Zocalos_Libres = $_SESSION['Zocalos'];

///////Filtros Funcion////
if (isset($_POST['buscar']) || isset($_GET['buscar'])) {
    //header("location: ../Tablas PCs/Tabla-Computadoras.php?pagina=1");
    $where = "WHERE Procesador like '%$xProcesador%' AND Laboratorio Like '%$xLaboratorio%' ";
    if ($xRAM > 0)
        $where .= "AND RAM > " . $xRAM;
    if (!empty($Zocalos_Libres))
        $where .= " AND Zocalos_Libres > " . $Zocalos_Libres;
    //echo $where;
}
////Consulta a la base de datos/////
$Laboratorios = "SELECT * FROM `laboratorios` ";
$PCs = "SELECT * FROM pcs $where  limit $productosPorPagina offset $offset";
$resPCs = $conex->query($PCs);
$resLaboratorio = $conex->query($Laboratorios);
$sentencia = $base_de_datos->query("SELECT count(id) AS conteo FROM pcs $where");
$conteo = $sentencia->fetchObject()->conteo;
# Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
$paginas = ceil($conteo / $productosPorPagina);
$offset = ($pagina - 1) * $productosPorPagina;
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
                        if ($xLaboratorio == $RegistroLaboratorios['Laboratorio'])
                            echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . ' " selected>' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                        else echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                    }
                    ?>
                </select>
                <!--Procesador, ram y zocalos libres-->
                <input type="text" placeholder="Procesador..." value="<?php if (!empty($_SESSION['xProcesador'])) {
                                                                            echo $_SESSION['xProcesador'];
                                                                        } ?>" name="xProcesador">
                <input type="number" name="xRAM" value="<?php if (!empty($_SESSION['xRAM'])) {
                                                            echo $_SESSION['xRAM'];
                                                        } ?>" placeholder="PC con RAM mayor a..." />
                Ver pc con zocalos Libres<input type="checkbox" name="Zocalos_Libres?" value="1" <?php if (!empty($_SESSION['Zocalos'])) echo "checked" ?> />
                <!-- Boton de busqueda -->
                <button name="buscar" type="submit">Buscar</button>
            </form>

            <br></br>
            <?php
            //Mensaje de error si no se encontro los datos que se insertaron en el filtro

           
            if (mysqli_num_rows($resPCs) == 0) {
                $mensaje = "<h1>No se encontraron mas registros con esas busquedas</h1>";
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
            <!-- Paginacion -->
            <ul class="pagination">
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a href="./Tabla-Computadoras.php?buscar=1&pagina=<?php echo $pagina - 1 ?>">«
                        </a>
                    </li>
                <?php } ?>
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo "active" ?>">
                        <a href="./Tabla-Computadoras.php?buscar=1&pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <?php if ($pagina < $paginas) { ?>
                    <li>
                        <a href="./Tabla-Computadoras.php?buscar=1&pagina=<?php echo $pagina + 1 ?>">»
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </body>

    </html>