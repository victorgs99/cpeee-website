<?php
    require_once "conexion.php";

    class CAD{
        #Función para agregar un usuario (registro)
        static public function AgregaUsuario($nombre, $correo, $contrasena){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("INSERT INTO usuario (nombre_usuario, correo, contrasena, rol_usuario) VALUES ('$nombre', '$correo', '$contrasena', '1')");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función para agregar una evidencia
        static public function AgregaEvidencia($nombre, $descripcion, $categoria, $idUsuario){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("INSERT into evidencia (nombre, descripcion, categoria, estado_esvisible, oculto_poradmin, id_usuario) VALUES ('$nombre', '$descripcion', '$categoria', '1', '0', '$idUsuario')");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función para agregar un archivo
        static public function AgregaArchivo($tipo, $archivo, $idEvidencia){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("INSERT into archivop (tipo, archivo, id_evidencia) VALUES ('$tipo', '$archivo', '$idEvidencia')");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función para agregar un enlace
        static public function AgregaEnlace($link, $idEvidencia){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("INSERT into enlace (link, id_evidencia) VALUES ('$link', '$idEvidencia')");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que regresa el id de una evidencia a partir de su nombre y idusuario
        static public function ObtieneIdEvidencia($nombre, $idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT id_evidencia FROM evidencia WHERE nombre = '$nombre' AND id_usuario = '$idUsuario'");
            
            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    return $row[0];
                }else{
                    return 0;
                }
            }
        }

        #Función que regresa los datos de una evidencia de un usuario
        static public function ObtieneEvidenciaUsuario($idEvidencia, $idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT nombre, descripcion, estado_esvisible, oculto_poradmin FROM evidencia WHERE id_evidencia = '$idEvidencia' AND id_usuario = '$idUsuario'");

            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    return $row;
                }else{
                    return null;
                }
            }
        }

        #Función que regresa los datos de todas las evidencias publicadas (no ocultas)
        static public function ObtieneTodasLasEvidencias(){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT * FROM evidencia WHERE estado_esvisible = '1' AND oculto_poradmin = '0' ORDER BY id_evidencia DESC");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa los datos de todas las evidencias publicadas (no ocultas) por sección
        static public function ObtieneTodasLasEvidenciasPorSeccion($seccion){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT * FROM evidencia WHERE categoria = '$seccion' AND estado_esvisible = '1' AND oculto_poradmin = '0' ORDER BY id_evidencia DESC");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa los datos de todas las evidencias publicadas (no ocultas) por busqueda
        static public function ObtieneEvidenciasPorBusqueda($palabraClave){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT * FROM evidencia WHERE estado_esvisible = '1' AND oculto_poradmin = '0' AND nombre LIKE '%$palabraClave%' ORDER BY id_evidencia DESC");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa los datos de todas las evidencias de un usuario (no ocultas)
        static public function ObtieneTodasLasEvidenciasDeUsuario($idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT * FROM evidencia WHERE id_usuario = '$idUsuario' AND estado_esvisible = '1' AND oculto_poradmin = '0'");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa todos los datos de un usuario
        static public function ObtieneDatosUsuario($idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT * from usuario WHERE id_usuario = '$idUsuario'");

            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    return $row;
                }else{
                    return null;
                }
            }
        }

        #Función que regresa todos los archivos de la evidencia
        static public function ObtieneArchivosEvidenciaUsuario($idUsuario, $idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT a.tipo, a.archivo FROM archivop a, evidencia e, usuario u where e.id_usuario = u.id_usuario AND a.id_evidencia = e.id_evidencia AND u.id_usuario = '$idUsuario' and e.id_evidencia = '$idEvidencia'");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa todos los enlaces de la evidencia del usuario
        static public function ObtieneEnlacesEvidenciaUsuario($idUsuario, $idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT l.link FROM enlace l, evidencia e, usuario u where e.id_usuario = u.id_usuario AND l.id_evidencia = e.id_evidencia AND u.id_usuario = '$idUsuario' AND e.id_evidencia = '$idEvidencia'");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función para verificar si el usuario existe o no
        static public function VerificaUsuario($nombre, $contrasena){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("SELECT * FROM usuario where nombre_usuario = '$nombre' AND contrasena = '$contrasena'");

            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    $_SESSION['sessIdUsuario'] = $row[0];
                    $_SESSION['sessNombreUsuario'] = $row[1];
                    $_SESSION['sessRolUsuario'] = $row[7];

                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        #Función para verificar si el nombre de usuario esta disponible (registro)
        static public function VerificaSiExisteNombreUsuario($nombre){
            $con = new Conexion();
            $query = $con->Conectar()->prepare("SELECT nombre_usuario FROM usuario");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    if($row['nombre_usuario'] == $nombre){
                        return true;
                    }
                }
                return false;
            }else{
                return false;
            }
        }

        #Función que modifica la información de contacto del usuario
        static public function ModificaInfoContacto($datosModificar, $idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE usuario SET $datosModificar WHERE id_usuario = $idUsuario");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que modifica los datos de una evidencia del usuario
        static public function ModificaDatosEvidencia($datosModificar, $idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE evidencia SET $datosModificar WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que regresa el id, nombre de los usuarios
        static public function ObtieneIdNombreUsuarios(){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT id_usuario, nombre_usuario FROM usuario");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa el id, nombre, estado de todas las evidencias del usuario
        static public function ObtieneIdNombreEvidencias($idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT e.id_evidencia, e.nombre, e.estado_esvisible FROM evidencia e, usuario u WHERE oculto_poradmin = 0 AND e.id_usuario = u.id_usuario AND u.id_usuario = $idUsuario");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que oculta una evidencia del usuario
        static public function OcultaEvidencia($idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE evidencia SET estado_esvisible = 0 WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que muestra una evidencia del usuario
        static public function MuestraEvidencia($idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE evidencia SET estado_esvisible = 1 WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que elimina una evidencia del usuario
        static public function EliminaEvidencia($idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("DELETE FROM evidencia WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que regresa el id y nombre de los usuarios
        static public function ObtieneIdNombreUsuariosParaAdministrador(){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT id_usuario, nombre_usuario FROM usuario WHERE rol_usuario = 1");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que regresa el id, nombre, estado de todas las evidencias del usuario para el administrador
        static public function ObtieneIdNombreEvidenciasParaAdministrador($idUsuario){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT e.id_evidencia, e.nombre, e.oculto_poradmin FROM evidencia e, usuario u WHERE e.id_usuario = u.id_usuario AND u.id_usuario = $idUsuario");

            if($query->execute()){
                $datos = [];
                #Mas de un registro
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $datos[] = $row;
                }
                return $datos;
            }else{
                return false;
            }
        }

        #Función que oculta una evidencia del usuario por el administrador
        static public function OcultaEvidenciaPorAdministrador($idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE evidencia SET oculto_poradmin = 0 WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que muestra una evidencia del usuario por el administrador
        static public function MuestraEvidenciaPorAdministrador($idEvidencia){
            $con = new Conexion();
            $query = $con->conectar()->prepare("UPDATE evidencia SET oculto_poradmin = 1 WHERE id_evidencia = $idEvidencia");
            
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }

        #Función que regresa la cantidad de usuarios registrados en la pagina
        static public function ObtieneUsuariosRegistrados(){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT COUNT(id_usuario) FROM usuario");
            
            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    return $row[0];
                }else{
                    return 0;
                }
            }
        }

        #Función que regresa el total de evidencias publicadas en la pagina
        static public function ObtieneEvidenciasPublicadas(){
            $con = new Conexion();
            $query = $con->conectar()->prepare("SELECT COUNT(id_evidencia) FROM evidencia");
            
            if($query->execute()){
                $row = $query->fetch(PDO::FETCH_NUM);

                if($row){
                    return $row[0];
                }else{
                    return 0;
                }
            }
        }
    }
?>