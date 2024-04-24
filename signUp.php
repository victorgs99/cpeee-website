<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link href="css/signUp.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>CPEEE - Registrate</title>
    </head>
    <body>
        <div class="PageContainer">
            <!--Sección de la barra top-->
            <div class="TopBar">
                <div id="LeftContent">
                    <img class="LogoImg" src="img/imgLogo.png" alt="Logo CPEEE">
                </div>
                <div id="RightContent">
                    <a class="LoginButton" href="login.php"><span>Login</span></a>
                </div>
            </div>

            <!--Sección de la imagen del encabezado-->
            <div class="HeaderImg">
                <img src="img/registerHeader.png" alt="Encabezado CPEEE">
            </div>

            <!--Sección del menu-->
            <div class="Menu">
                <a class="HomeButton" href="index.php"><i class="fa fa-home fa-2x"></i></a>

                <a class="MenuButton" href=""><span>Imagen e Ilustración</span></a>
                <a class="MenuButton" href=""><span>Video y Cortometraje</span></a>
                <a class="MenuButton" href=""><span>Audio y Música</span></a>
                <a class="MenuButton" href=""><span>Videojuego e Interacción</span></a>
                
                <div class="MenuMobile">
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
            <div id="SignUpContainer">
                <div class="SignUpPanel">
                    <div class="TitleSignUp"><span>Registro de usuario</span></div>
                    <form class="SignUpForm" action="registerUser.php" method="post">
                        <div class="FormField">
                            <label><i class="fa fa-user"></i></label>
                            <input type="text" placeholder="Nombre de usuario" name="nombreUsuario">
                        </div>
                        <div class="FormField">
                            <label><i class="fa fa-envelope"></i></label>
                            <input type="text" placeholder="Correo electrónico" name="correoUsuario">
                        </div>
                        <div class="FormField">
                            <label><i class="fa fa-lock"></i></label>
                            <input type="password" placeholder="Contraseña" name="contrasenaUsuario">
                        </div>
                        <div class="SubmitButton">
                            <button type="submit"><span>Registrarse</span></button>
                        </div>
                    </form>
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