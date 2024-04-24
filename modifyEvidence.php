<?php
    session_start();
    
    require_once "CAD.php";
    $cad = new CAD();

    if(isset($_GET['message'])){
        $bandMessage = false;
        if($_GET['message'] == 'success'){
            $bandMessage = true;
        }      
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link href="css/modifyEvidence.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>CPEEE - Modifica evidencia</title>
    </head>
    <body>
        <div class="PageContainer">
            <!--Sección de la barra top-->
            <div class="TopBar">
                <div id="LeftContent">
                    <img class="LogoImg" src="img/imgLogo.png" alt="Logo CPEEE">
                </div>
                <div id="RightContent">
                    <?php
                        if(isset($_SESSION['sessIdUsuario']) && isset($_SESSION['sessNombreUsuario']) && isset($_SESSION['sessRolUsuario'])){
                            echo "<a class='LoginButton' href='userPagePanel.php'><span>".$_SESSION['sessNombreUsuario']."</span></a>";
                            echo "<a class='SignUpButton' href='signOut.php'><span>Cerrar Sesión</span></a>";
                        }else{
                            echo "<a class='LoginButton' href='login.php'><span>Login</span></a>";
                            echo "<a class='SignUpButton' href='signUp.php'><span>Sign Up</span></a>";
                        }
                    ?>
                </div>
            </div>

            <!--Sección de la imagen del encabezado-->
            <div class="HeaderImg">
                <img src="img/indexHeader.png" alt="Encabezado CPEEE">
            </div>

            <!--Sección del menu-->
            <div class="Menu">
                <a class="HomeButton" href="index.php"><i class="fa fa-home fa-2x"></i></a>

                <a class="MenuButton" href="imageSection.php"><span>Imagen e Ilustración</span></a>
                <a class="MenuButton" href="videoSection.php"><span>Video y Cortometraje</span></a>
                <a class="MenuButton" href="musicSection.php"><span>Audio y Música</span></a>
                <a class="MenuButton" href="gameSection.php"><span>Videojuego e Interacción</span></a>
                
                <div class="MenuMobile">
                    <input type="checkbox" id="MenuSearchBar">
                    <label for="MenuSearchBar"><i class="fa fa-search fa-2x"></i></label>

                    <form class="M_SearchBar" action="" method="get">
                        <input type="text" placeholder="Busca evidencia" name="Keyword" maxlength="10">
                    </form>
                    
                    <input type="checkbox" id="MenuBar">
                    <label for="MenuBar"><i class="fa fa-bars fa-2x"></i></label>

                    <div class="Buttons">
                        <a href="imageSection.php"><i class="fa fa-picture-o"></i><span>Imagen e Ilustración</span></a>
                        <a href="videoSection.php"><i class="fa fa-play"></i><span>Video y Cortometraje</span></a>
                        <a href="musicSection.php"><i class="fa fa-music"></i><span>Audio y Música</span></a>
                        <a href="gameSection.php"><i class="fa fa-gamepad"></i><span>Videojuego e Interacción</span></a>
                    </div>
                </div>
            </div>

            <!--Sección del panel-->
            <div class="PanelContainer">
                <div id="PrincipalPanel">
                    <div class="OperationPanelTitle"><span>Modificar evidencia</span></div>
                    <div class="OperationPanel">
                        <div>
                            <span class="LabelOne">Selecciona la evidencia a modificar</span>
                        </div>
                        <div class="TablePanel">
                            <?php
                                if(!isset($_GET['idEvidencia'])){
                                    $datos = $cad->ObtieneIdNombreEvidencias($_SESSION['sessIdUsuario']);
                                
                                    if($datos){
                                        echo "<table id='DataTable'>";
    
                                        foreach($datos as $registro){
                                            echo "<tr>";
                                            echo "<td>".$registro['nombre']."</td>";
                                            $idEvidencia = $registro['id_evidencia'];
                                            echo "<td><a href='modifyEvidence.php?idEvidencia=$idEvidencia'>Modificar</a></td>";
                                            echo "</tr>";
                                        }
    
                                        echo "</table>";
                                    }else{
                                        echo "<div><span class='LabelZero'>No tienes evidencias</span></div>";
                                    }
                                }else{
                                    echo "<div><span class='LabelZero'>Evidencia ya seleccionada</span></div>";
                                }
                            ?>
                        </div>
                        <?php
                            if(isset($_GET['idEvidencia'])){
                                $idEvidencia = $_GET['idEvidencia'];
                                echo "<div><span class='LabelOne'>Llena los campos con la información que desees modificar<br>(Los archivos y enlaces no pueden modificarse)</span></div>";
                                
                                echo "<div class='FormPanel'>";
                                echo "<form class='UpdateInfoForm' action='modify.php' method='post'>";
                                echo "<div class='FormField'>";
                                echo "<label><i class='fa fa-user'></i><span>Título de la evidencia</span></label>";
                                echo "<input type='text' name='nombre'>";
                                echo "</div>";
                                echo "<div class='FormField'>";
                                echo "<label><i class='fa fa-map-marker'></i><span>Descripción de la evidencia</span></label>";
                                echo "<input type='text' name='descripcion'>";
                                echo "</div>";
                                echo "<div class='FormField'>";
                                echo "<input name='idEvidencia' type='hidden' value='$idEvidencia'>";
                                echo "</div>";
                                echo "<div class='SubmitButton'>";
                                echo "<button type='submit'><span>Modificar evidencia</span></button>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <div id="SideBarPanel">
                    <div class="PanelMessage">
                        <div class="TitleMessage"><span>Resultado de la operación</span></div>
                        <div class="Message">
                            <?php
                                if(isset($bandMessage)){
                                    if($bandMessage){
                                        echo "<span>La evidencia ha sido modificada</span>";    
                                    }else{
                                        echo "<span>La evidencia no pudo modificarse</span>";
                                    }
                                }else{
                                    echo "<span>Sin operación</span>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sección del pie-->
            <div class="Footer">
                <div id="FooterUp">
                    <span>Copyright <i class="fa fa-copyright"></i> 2022 | <a href=""><span>Catalogo de Proyectos Escolares Enfocados en el Entretenimiento</span></a></span>
                </div>
                <div id="FooterDown">
                    <span>Diseño por Victor Gómez | <a href="https://www.uaslp.mx/#gsc.tab=0"><span>Universidad Autónoma de San Luis Potosí</span></a> | Fundamentos de Desarrollo Web</span>
                </div>
            </div>
        </div>
    </body>
</html>