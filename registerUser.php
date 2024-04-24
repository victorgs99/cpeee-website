<?php
    require_once "CAD.php";

    if(isset($_POST['nombreUsuario']) && isset($_POST['correoUsuario']) && isset($_POST['contrasenaUsuario'])){
        $nombreAux = $_POST['nombreUsuario'];
        $correoAux = $_POST['correoUsuario'];
        $contrasenaAux = $_POST['contrasenaUsuario'];

        if($nombreAux && $correoAux && $contrasenaAux){
            $cad = new CAD();

            if(!$cad->VerificaSiExisteNombreUsuario($nombreAux)){
                if(preg_match("|^(?=.*[A-Z])(?=.*[!@#$&])(?=.*[0-9])(?=.*[a-z]).{8,}$|", $contrasenaAux)){
                
                    session_start();
    
                    if($cad->AgregaUsuario($nombreAux, $correoAux, $contrasenaAux)){
                        if($cad->VerificaUsuario($nombreAux, $contrasenaAux)){
                            header("Location: index.php");
                        }else{
                            session_destroy();
                            echo "<script language='javascript'>alert('¡Error! El usuario no se encontro en la BD'); location='signUp.php';</script>";
                        }
                    }else{
                        session_destroy();
                        echo "<script language='javascript'>alert('¡Error! El usuario no pudo ser registrado'); location='signUp.php';</script>";
                    }
                }else{
                    echo "<script language='javascript'>alert('La contraseña debe de contener como mínimo un carácter especial, un número, una letra mayúscula, una minúscula y al menos 8 caracteres'); location='signUp.php';</script>";
                }
            }else{
                echo "<script language='javascript'>alert('El nombre de usuario ya esta registrado'); location='signUp.php';</script>";
            } 
        }else{
            echo "<script language='javascript'>alert('Debes de llenar todos los campos para registrarte'); location='signUp.php';</script>";        
        }
    }

    unset($_POST['nombreUsuario']);
    unset($_POST['correoUsuario']);
    unset($_POST['contrasenaUsuario']);
    /*$cad = new CAD();
        session_start();

        if($cad->AgregaUsuario($nombreAux, $correoAux, $contrasenaAux)){
            if($cad->VerificaUsuario($nombreAux, $contrasenaAux)){
                //header("Location: index.php");
                $aux1 = $_SESSION['sessIdUsuario'];
                $aux2 = $_SESSION['sessNombreUsuario'];
                $aux3 = $_SESSION['sessRolUsuario'];
    
                echo "<h1>$aux1,$aux2,$aux3</h1>";
            }
        }else{
            echo "<h1>ERROR EN ALGO xd</h1>";
        }

    session_destroy();*/
?>