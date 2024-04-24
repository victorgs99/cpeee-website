<?php
    session_start();
    
    require_once "CAD.php";

    $datosModificar = "";
    $bandNombre = false;
    $bandDescripcion = false;

    if(isset($_POST['descripcion'])){
        if($_POST['descripcion'] != ""){
            $descripcion = $_POST['descripcion'];
            $datosModificar = "descripcion = '$descripcion'";
            $bandDescripcion = true;
        }
    }

    if(isset($_POST['nombre'])){
        if($_POST['nombre'] != ""){
            $nombre = $_POST['nombre'];
            if($bandDescripcion){
                $aux = $datosModificar;
                $datosModificar = "nombre = '$nombre',".$aux;
            }else{
                $datosModificar = "nombre = '$nombre'";
            }
            $bandNombre = true;
        }
    }

    if($bandNombre || $bandDescripcion){
        $cad = new CAD();

        if($cad->ModificaDatosEvidencia($datosModificar, $_POST['idEvidencia'])){
            header("Location: modifyEvidence.php?message=success");
        }else{
            header("Location: modifyEvidence.php?message=error");
        }
    }

    unset($_POST['nombre']);
    unset($_POST['descripcion']);
    unset($_POST['idEvidencia']);
    $datosModificar = "";
?>