<?php
    session_start();
    
    require_once "CAD.php";
    $cad = new CAD();

    if(isset($_GET['idEvidencia']) && isset($_GET['idUsuario'])){
        $datosEvidencia = $cad->ObtieneEvidenciaUsuario($_GET['idEvidencia'], $_GET['idUsuario']);
        $datosUsuario = $cad->ObtieneDatosUsuario($_GET['idUsuario']);
        $archivos = $cad->ObtieneArchivosEvidenciaUsuario($_GET['idUsuario'], $_GET['idEvidencia']);
        $enlaces = $cad->ObtieneEnlacesEvidenciaUsuario($_GET['idUsuario'], $_GET['idEvidencia']);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link href="css/evidencePage.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <?php
            echo "<title>$datosEvidencia[0]</title>";
        ?>
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
                    <div class="EvidenceName">
                        <div class="Name"><?php echo "<span>$datosEvidencia[0]</span>"; ?></div>
                        <?php echo "<div class='UserName'>Creado por: <a href='userPage.php?idUsuario=".$datosUsuario[0]."'><span>".$datosUsuario[1]."</span></a></div>"; ?>
                    </div>
                    <div class="PrincipalImage">
                        <?php
                            $band = true;

                            foreach($archivos as $archivo){
                                if(($archivo['tipo'] == "image/png" || $archivo['tipo'] == "image/jpeg" || $archivo['tipo'] == "image/gif") && $band){
                                    $band = false;
                                    echo "<img src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'>";
                                }
                            }

                            if($band){
                                echo "<div class='ContactInformation'><span>Sin imagen principal</span></div>";
                            }
                        ?>
                    </div>
                    <div class="EvidenceDescription">
                        <?php echo "<p>$datosEvidencia[1]</p>"; ?>
                    </div>
                    <div class="EvidenceResources">
                        <div class="EvidenceSection">
                            <div class="SectionTitle"><span>Imágenes</span></div>
                            <div class="ImageResources">
                                <?php
                                    $band = true;

                                    foreach($archivos as $archivo){
                                        if($archivo['tipo'] == "image/png" || $archivo['tipo'] == "image/jpeg" || $archivo['tipo'] == "image/gif"){
                                            $band = false;
                                            echo "<img src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'>";
                                        }
                                    }

                                    if($band){
                                        echo "<div class='ContactInformation'><span>Sin imágenes</span></div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="EvidenceSection">
                            <div class="SectionTitle"><span>Videos</span></div>
                            <div class="VideoResources">
                                <?php
                                    $band = true;

                                    foreach($archivos as $archivo){
                                        if($archivo['tipo'] == "video/3gpp" || $archivo['tipo'] == "video/mp4" || $archivo['tipo'] == "video/webm"){
                                            $band = false;
                                            echo "<video controls><source src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'></video>";
                                        }
                                    }

                                    if($band){
                                        echo "<div class='ContactInformation'><span>Sin videos</span></div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="EvidenceSection">
                            <div class="SectionTitle"><span>Audios</span></div>
                            <div class="AudioResources">
                                <?php
                                    $band = true;

                                    foreach($archivos as $archivo){
                                        if($archivo['tipo'] == "audio/ogg" || $archivo['tipo'] == "audio/mp3"){
                                            $band = false;
                                            echo "<audio controls><source src='data:".$archivo['tipo'].";base64,".base64_encode($archivo['archivo'])."'></audio>";
                                        }
                                    }

                                    if($band){
                                        echo "<div class='ContactInformation'><span>Sin audios</span></div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="EvidenceSection">
                            <div class="SectionTitle"><span>Enlaces</span></div>
                            <div class="LinkResources">
                                <?php
                                    $band = true;

                                    if($enlaces != null){
                                        $band = false;
                                        foreach($enlaces as $tupla){
                                            $enlace = $tupla['link'];
                                            echo "<a href='$enlace'><i class='fa fa-external-link'></i><span>Enlace externo</span><i class='fa fa-external-link'></i></a>";
                                        }
                                    }

                                    if($band){
                                        echo "<div class='ContactInformation'><span>Sin enlaces</span></div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="EvidenceFooter">
                        <div class="MostInterestingButton"><i class="fa fa-thumbs-o-up"></i><span>Me parece interesante</span></div>
                        <div class="ContactInformation">
                            <?php
                                echo "<span>$datosUsuario[4]</span>";
                                echo "<span>$datosUsuario[2]</span>";
                                echo "<span>$datosUsuario[6]</span>";
                                echo "<span>$datosUsuario[5]</span>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div id="SideBarContent">
                    <form class="SearchBar">
                        <input type="text" placeholder="Busca evidencia" name="q" autocomplete="on" minlength="10" maxlength="50">
                        <button type="submit"><i class="fa fa-search fa-lg"></i></button>
                    </form>
                    <div class="WebSiteDescription">
                        <div class="DescriptionTitle">
                            <span>Destaca a esta evidencia</span>
                        </div>
                        <div class="DescriptionIcon">
                            <i class="fa fa-thumbs-o-up"></i>
                        </div>
                        <div class="Description">
                            <p>Una evidencia representa un buen trabajo, 
                                pero como todo en esta vida siempre debe haber un destacado.
                                <br><br>Si consideras que esta evidencia es sobresaliente a las demas, porfavor dale 
                                un <span>"Me parece interesante"</span>.
                            </p>
                        </div>
                    </div>
                    <div class="CommentsContainer">
                        <div class="CommentsTitle">
                            <span>Comentarios de la evidencia</span>
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