<?php
    require_once "CAD.php";
    
    if(isset($_POST['nombreUsuario']) && isset($_POST['contrasenaUsuario'])){
        $nombreAux = $_POST['nombreUsuario'];
        $contrasenaAux = $_POST['contrasenaUsuario'];

        if($nombreAux && $contrasenaAux){
            $cad = new CAD();
            session_start();
            
            if($cad->VerificaUsuario($nombreAux, $contrasenaAux)){
                header("Location: index.php");
            }else{
                session_destroy();
                echo "<script language='javascript'>alert('Tu nombre de usuario o contraseña es incorrecta'); location='login.php';</script>";
            }
        }else{
            echo "<script language='javascript'>alert('Debes de llenar todos los campos para iniciar sesión'); location='login.php';</script>";
        }
    }

    unset($_POST['nombreUsuario']);
    unset($_POST['contrasenaUsuario']);
?>