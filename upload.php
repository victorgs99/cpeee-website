<?php
    require_once "CAD.php";
    
    if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria'])){
        $nombreAux = $_POST['nombre'];
        $descripcionAux = $_POST['descripcion'];

        switch($_POST['categoria']){
            case 1:
                $categoriaAux = "Imagen e Ilustración";
                break;
            case 2:
                $categoriaAux = "Video y Cortometraje";
                break;
            case 3:
                $categoriaAux = "Audio y Música";
                break;
            case 4:
                $categoriaAux = "Videojuego e Interacción";
                break;
        }

        if($nombreAux && $descripcionAux && $categoriaAux){
            $cad = new CAD();
            session_start();
            
            if($cad->AgregaEvidencia($nombreAux, $descripcionAux, $categoriaAux, $_SESSION['sessIdUsuario'])){
                $idEvidencia = $cad->ObtieneIdEvidencia($nombreAux, $_SESSION['sessIdUsuario']);
                $archivo = $_FILES['archivo'];
                $numArchivos = count($archivo['name']);
    
                if($numArchivos){
                    for($i = 0; $i < $numArchivos; $i++){
                        if($archivo['name'][$i]){
                            $type = $archivo['type'][$i];
        
                            $tmp_name = $archivo['tmp_name'][$i];
                            $contenido_archivo = file_get_contents($tmp_name);
                            $archivoBLOB = addslashes($contenido_archivo);
        
                            if(!$cad->AgregaArchivo($type, $archivoBLOB, $idEvidencia)){
                                echo "<script language='javascript'>alert('Error al subir los archivos'); location='uploadEvidence.php?message=success';</script>";
                            }
                        }
                    }
                }
                
                $enlaces = $_POST['enlace'];

                foreach($enlaces as $enlace){
                    if($enlace != ""){
                        $cad->AgregaEnlace($enlace, $idEvidencia);
                    }
                }

                header("Location: uploadEvidence.php?message=success");
            }else{
                header("Location: uploadEvidence.php?message=error");
            }
        }else{
            echo "<script language='javascript'>alert('Mínimo debes de llenar los campos título, descripción y categoria de tu evidencia'); location='uploadEvidence.php';</script>";
        }
    }

    unset($_POST['nombre']);
    unset($_POST['descripcion']);
    unset($_POST['categoria']);
    unset($_FILES['archivo']);
    unset($_POST['enlace']);


    
    /*$titulo = $_POST['nombre'];
    $description = $_POST['descripcion'];*/

    /*
    $archivo = $_FILES['archivo'];
    $numArchivos = count($archivo['name']);

    echo $numArchivos."<br>";

    for($i = 0; $i < $numArchivos; $i++){
        if($archivo['name'][$i]){
            $tmp_name = $archivo['tmp_name'][$i];
            $contenido_archivo = file_get_contents($tmp_name);
            $archivoBLOB = addslashes($contenido_archivo);
            echo $archivoBLOB;
            echo "<br><br><br>";
        }
    }*/

    /*
    $archivo = $_FILES['archivo'];
    $numArchivos = count($archivo['name']);

    for($i = 0; $i < $numArchivos; $i++){
        echo $archivo['name'][$i]."<br>";
        echo $archivo['full_path'][$i]."<br>";
        echo $archivo['type'][$i]."<br>";
        echo $archivo['tmp_name'][$i]."<br>";
        echo $archivo['error'][$i]."<br>";
        echo $archivo['size'][$i]."<br><br>";
    }
    */
?>