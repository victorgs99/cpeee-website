<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link href="css/userPage.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>CPEEE - NombreUsuario</title>
    </head>
    <body>
        <div class="PageContainer">
            <!--Sección de la barra top-->
            <div class="TopBar">
                <div id="LeftContent">
                    <img class="LogoImg" src="img/imgLogo.png" alt="Logo CPEEE">
                </div>
                <div id="RightContent">
                    <a class="LoginButton" href=""><span>Login</span></a>
                    <a class="SignUpButton" href=""><span>Sign Up</span></a>
                </div>
            </div>

            <!--Sección de la imagen del encabezado-->
            <div class="HeaderImg">
                <img src="img/indexHeader.png" alt="Encabezado CPEEE">
            </div>

            <!--Sección del menu-->
            <div class="Menu">
                <a class="HomeButton" href=""><i class="fa fa-home fa-2x"></i></a>

                <a class="MenuButton" href=""><span>Imagen e Ilustración</span></a>
                <a class="MenuButton" href=""><span>Video y Cortometraje</span></a>
                <a class="MenuButton" href=""><span>Audio y Música</span></a>
                <a class="MenuButton" href=""><span>Videojuego e Interacción</span></a>
                
                <div class="MenuMobile">
                    <input type="checkbox" id="MenuSearchBar">
                    <label for="MenuSearchBar"><i class="fa fa-search fa-2x"></i></label>

                    <form class="M_SearchBar">
                        <input type="text" placeholder="Busca evidencia" name="q" autocomplete="off">
                    </form>
                    
                    <input type="checkbox" id="MenuBar">
                    <label for="MenuBar"><i class="fa fa-bars fa-2x"></i></label>

                    <div class="Buttons">
                        <a href=""><i class="fa fa-picture-o"></i><span>Imagen e Ilustración</span></a>
                        <a href=""><i class="fa fa-play"></i><span>Video y Cortometraje</span></a>
                        <a href=""><i class="fa fa-music"></i><span>Audio y Música</span></a>
                        <a href=""><i class="fa fa-gamepad"></i><span>Videojuego e Interacción</span></a>
                    </div>
                </div>
            </div>

            <!--Sección del contenido-->
            <div class="ContentContainer">
                <div id="PrincipalContent">
                    <div class="FilterContainer">
                        <div class="FilterText"><span>Filtrar evidencias: </span></div>
                        <div class="FilterOptions">
                            <input type="radio" name="filter" id="MostRecent" checked>
                            <label for="MostRecent">Más recientes</label>
                            <input type="radio" name="filter" id="Oldest">
                            <label for="Oldest">Más antiguos</label>
                            <input type="radio" name="filter" id="MostVoted">
                            <label for="MostVoted">Más votados</label>
                        </div>
                    </div>
                    <div class="EvidenceContent">
                        <div class="EvidenceImg">
                            <a class="EvidenceLink" href=""><img src="img/indexEvidence.gif" alt="Imagen de la descripción"></a>
                        </div>
                        <div class="EvidenceData">
                            <div class="EvidenceTitle">
                                <a href=""><span>Título de la evidencia Título de la evidencia</span></a>
                            </div>
                            <div class="EvidenceDescription">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis autem ipsa consequuntur voluptate
                                    officiis quo a odio tempore, ut mollitia? Voluptas, aperiam adipisci sapiente ad temporibus nobis!
                                    Aspernatur, corporis quaerat. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="EvidenceContent">
                        <div class="EvidenceImg">
                            <a class="EvidenceLink" href=""><img src="img/indexEvidence.gif" alt="Imagen de la descripción"></a>
                        </div>
                        <div class="EvidenceData">
                            <div class="EvidenceTitle">
                                <a href=""><span>Título de la evidencia Título de la evidencia</span></a>
                            </div>
                            <div class="EvidenceDescription">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis autem ipsa consequuntur voluptate
                                    officiis quo a odio tempore, ut mollitia? Voluptas, aperiam adipisci sapiente ad temporibus nobis!
                                    Aspernatur, corporis quaerat. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="EvidenceContent">
                        <div class="EvidenceImg">
                            <a class="EvidenceLink" href=""><img src="img/indexEvidence.gif" alt="Imagen de la descripción"></a>
                        </div>
                        <div class="EvidenceData">
                            <div class="EvidenceTitle">
                                <a href=""><span>Título de la evidencia Título de la evidencia</span></a>
                            </div>
                            <div class="EvidenceDescription">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis autem ipsa consequuntur voluptate
                                    officiis quo a odio tempore, ut mollitia? Voluptas, aperiam adipisci sapiente ad temporibus nobis!
                                    Aspernatur, corporis quaerat. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="NextPageButton">
                        <a href=""><span>Evidencias antiguas</span></a>
                    </div>
                </div>
                <div id="SideBarContent">
                    <form class="SearchBar">
                        <input type="text" placeholder="Busca evidencia" name="q" autocomplete="on" minlength="10" maxlength="50">
                        <button type="submit"><i class="fa fa-search fa-lg"></i></button>
                    </form>
                    <div class="UserPanel">
                        <div class="PanelTitle">
                            <span>PANEL DE USUARIO</span>
                        </div>
                        <div class="PanelButtons">
                            <a href=""><span>Publicar evidencia</span></a>
                            <a href=""><span>Modificar evidencia</span></a>
                            <a href=""><span>Ocultar evidencia</span></a>
                            <a href="deleteEvidence.php"><span>Eliminar evidencia</span></a>
                        </div>
                    </div>
                    <div class="CommentsContainer">
                        <div class="CommentsTitle">
                            <span>Comentarios para el usuario</span>
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