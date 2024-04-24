<?php
    session_start();

    require_once "CAD.php";
    $cad = new CAD();

    
    
    if(isset($_GET['Keyword'])){
        $evidencias = $cad->ObtieneEvidenciasPorBusqueda($_GET['Keyword']);
    }else{
        $evidencias = $cad->ObtieneTodasLasEvidencias();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link href="css/index.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>CPEEE - Inicio</title>
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

            <!--Sección del contenido-->
            <div class="ContentContainer">
                <div id="PrincipalContent">
                    <?php
                        foreach($evidencias as $evidencia){
                            $idEvidenciaAux = $evidencia['id_evidencia'];
                            $nombreEvidenciaAux = $evidencia['nombre'];
                            $descripcionEvidenciaAux = $evidencia['descripcion'];
                            $datosUsuarioAux = $cad->ObtieneDatosUsuario($evidencia['id_usuario']); 

                            echo "<div class='EvidenceContent'>";
                            
                            $archivos = $cad->ObtieneArchivosEvidenciaUsuario($datosUsuarioAux[0], $idEvidenciaAux);
                            $band = true;

                            foreach($archivos as $archivo){
                                if(($archivo['tipo'] == "image/png" || $archivo['tipo'] == "image/jpeg" || $archivo['tipo'] == "image/gif") && $band){
                                    $band = false;
                                    //echo "<img src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'>";
                                    echo "<div class='EvidenceImg'><a class='EvidenceLink' href='evidencePage.php?idEvidencia=$idEvidenciaAux&idUsuario=".$datosUsuarioAux[0]."'><img src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'></a></div>";
                                }
                            }

                            if($band){
                                echo "<div class='EvidenceImg'><a class='EvidenceLink' href='evidencePage.php?idEvidencia=$idEvidenciaAux&idUsuario=".$datosUsuarioAux[0]."'><img src='img/indexEvidence.gif'></a></div>";
                            }

                            echo "<div class='EvidenceData'>";
                            echo "<div class='EvidenceTitle'><a href='evidencePage.php?idEvidencia=$idEvidenciaAux&idUsuario=".$datosUsuarioAux[0]."'><span>$nombreEvidenciaAux</span></a></div>";
                            echo "<div class='EvidenceDescription'><p>$descripcionEvidenciaAux</p></div>";
                            echo "<div class='EvidenceUploadInfo'><span>Por: <a href='userPage.php?idUsuario=".$datosUsuarioAux[0]."'><span class='UserName'>".$datosUsuarioAux[1]."</span></a></span></div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
                <div id="SideBarContent">
                    <form class="SearchBar" action="" method="get">
                        <input type="text" placeholder="Busca evidencia" name="Keyword" maxlength="10">
                        <button type="submit"><i class="fa fa-search fa-lg"></i></button>
                    </form>
                    <div class="WebSiteDescription">
                        <div class="DescriptionTitle">
                            <span>ACERCA DEL SITIO</span>
                        </div>
                        <div class="DescriptionImg">
                            <img src="img/indexDescription.gif" alt="Imagen de la descripción" title="Que el papel no quede en blanco">
                        </div>
                        <div class="Description">
                            <p>Un sitio web dedicado a todos esos proyectos escolares 
                                que quedan en el olvido despues de ser entregados.<br>
                                Sube evidencia de tus proyectos escolares para mostrarle al 
                                mundo tus habilidades.
                            </p>
                        </div>
                    </div>
                    <div class="CommentsContainer">
                        <div class="CommentsTitle">
                            <span>Comentarios Generales</span>
                        </div>
                        <div class="Comments">
                            <div class="Comment">
                                <a href=""><img src="img/userIcon.png" title="Usuario"></a>
                                <div>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                                </div>
                            </div>
                            <div class="Comment">
                                <a href=""><img src="img/userIcon.png" title="Usuario"></a>
                                <div>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                                </div>
                            </div>
                            <div class="Comment">
                                <a href=""><img src="img/userIcon.png" title="Usuario"></a>
                                <div>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                                </div>
                            </div>
                            <div class="Comment">
                                <a href=""><img src="img/userIcon.png" title="Usuario"></a>
                                <div>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                                </div>
                            </div>
                            <div class="Comment">
                                <a href=""><img src="img/userIcon.png" title="Usuario"></a>
                                <div>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                                </div>
                            </div>
                        </div>
                        <div class="CommentsSubmit">
                            <a class="CommentUserIcon" href=""><img src="img/userIcon.png" title="Usuario"></a>
                            <form class="CommentInput">
                                <input type="text" placeholder="Agrega comentario" name="t" autocomplete="off" minlength="6" maxlength="113">
                                <button type="submit"><i class="fa fa-paper-plane fa-lg"></i></button>
                            </form>
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