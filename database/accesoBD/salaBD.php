<?php
include_once "../objetos/sala.php";

    class salaBD
    {
        public function getSala($idSala, $conexion)
        {   
            $consulta = "SELECT Sala.*, Participa.*, Usuario.nickname FROM Sala NATURAL JOIN Participa NATURAL JOIN Usuario WHERE Id_sala = ?"; 
            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("i", $idSala);
            $instruccion->execute();
            $resultado = $instruccion->get_result();

            if($resultado->num_rows > 0)    //Si hay integrantes (no cuenta al creador) entonces se obtienen todos ellos
            {
                $primeraFila = $resultado->fetch_assoc(); //Obtengo la primer fila.

                //Esto ya itera al usar la funcion de arriba, asi que cuando empiece el while empieza desde el segundo integrante!
                //Agrego los datos de la sala y del primer integrante.
                $datosSala = new Sala($primeraFila["Id_sala"], $primeraFila["Titulo"], $primeraFila["Descripcion"], $primeraFila["Modalidad"], $primeraFila["nicknameCreador"], $primeraFila["Ubicacion"], $primeraFila["Fecha"], $primeraFila["Estado"]);
                $datosSala->agregarParticipante($primeraFila['nickname']);  //Este es el primer participante, que casi se me pierde.

                //Aca obtengo el nombre de cada participante.
                while($fila = $resultado->fetch_assoc())
                {
                    $datosSala->agregarParticipante($fila['nickname']);
                }
            }
            else    //Si no hay integrantes, obtengo solo los datos de la sala y el nick del creador.
            {
                $consulta1 = "SELECT * FROM Sala WHERE Id_sala = ?"; 
                $instruccion1 = $conexion->prepare($consulta1);
                $instruccion1->bind_param("i", $idSala);
                $instruccion1->execute();

                $fila = $instruccion1->get_result()->fetch_assoc();
                $datosSala = new Sala($fila["Id_sala"], $fila["Titulo"], $fila["Descripcion"], $fila["Modalidad"], $fila["nicknameCreador"], $fila["Ubicacion"], $fila["Fecha"], $fila["Estado"]);
                
            }
            
            return $datosSala;

        }

        public function getAllSalas($conexion)
        {
            
            $consulta = "SELECT * FROM Sala";

            if($this->eventStateUpdaterDetectorBeta($conexion) == false) //Si el actualizador de salas no existe o la variable de Schedule esta OFF en esta base de datos...
            {
                $this->emergencySalaUpdater($conexion); //Se ejecuta funcion auxiliae
                echo "Warning, no se ha detectado eventStateUpdater() en la base de datos, se ha utilizado funcion local auxiliar";
            }

            return mysqli_query($conexion, $consulta); 
        }  

        public function registrarSala($conexion, $datosSala)
        {   
            if($datosSala->getIdSala() == null || $datosSala->getIdSala() == -1) //Si es un objeto dirigido a ser almacenado (se envia como -1 o null))...
            {    
                $instruccion = $conexion->prepare("INSERT INTO Sala (Titulo, Descripcion, Modalidad, Ubicacion, Fecha, nicknameCreador, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $instruccion->bind_param("sssssss", $datosSala->getTitulo(), $datosSala->getDescripcion(), $datosSala->getModalidad(), $datosSala->getUbicacion(), $datosSala->getFechaHora(), $datosSala->getNickNameCreador(), $datosSala->getEstado());
                
                $resultado = $instruccion->execute(); //la ejecucion tambien retorna si salio bien o no.

                return $resultado;  //retorna true si se registro, si no retorna false directamente.
                
            }
            else
            {
                return false;
            }
        }

        public function obtenerSalasUsuario($conexion, $nickName)
        {
            $consulta = "SELECT DISTINCT Sala.* FROM Sala LEFT JOIN Participa ON Sala.Id_sala = Participa.Id_sala LEFT JOIN Usuario ON Participa.nickname = Usuario.nickname WHERE Sala.nicknameCreador = ? OR Participa.nickname = ?";
            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("ss", $nickName, $nickName);
            $instruccion->execute();
            $resultado = $instruccion->get_result();

            $salas = [];

            if($resultado->num_rows > 0)
            {
                while($salaIterada = $resultado->fetch_assoc())
                {
                    $salas[] = new Sala($salaIterada['Id_sala'], $salaIterada['Titulo'], $salaIterada['Descripcion'], $salaIterada['Modalidad'], $salaIterada['nicknameCreador'], $salaIterada['Ubicacion'], $salaIterada['Fecha'], $salaIterada['Estado']);
                }
            }

            return $salas;

        }

        public function getSalasFiltradas($conexion, $ingreso)
        {
            $textoRecortado = trim($ingreso);               //Limpia espacios de los bordes

            $arrayPalabras = explode(' ', $textoRecortado); //Separo cada palabra 

            $listaFiltrada = array_filter($arrayPalabras);  //Elimina string colados vacios

            if(!empty($listaFiltrada))     //Si la string no llega vacia
            {
                $partesRelevancia = [];
                $tipos = '';
                $valores = [];

                foreach($listaFiltrada as $palabra) 
                {
                    $like = "%{$palabra}%";
                    $partesRelevancia[] = "(Sala.Titulo LIKE ? OR Sala.Descripcion LIKE ?)";
                    $tipos .= 'ss';
                    $valores[] = $like;
                    $valores[] = $like;
                }

                $relevancia = implode(' + ', $partesRelevancia);    //Junto el array de importancia en un string solo

                $consulta = "SELECT Sala.*, ({$relevancia}) AS coincidencias FROM Sala HAVING coincidencias > 0 ORDER BY coincidencias DESC, Sala.Titulo ASC LIMIT ?";
                $tipos .= 'i';

                $valores[] = 20;

                $instruccion = $conexion->prepare($consulta);
                $instruccion->bind_param($tipos, ...$valores);
                $instruccion->execute();

                $resultado = $instruccion->get_result();

                if($resultado->num_rows != 0)   //Si la consulta encuentra algo
                {
                    return $resultado;
                }
                else
                {
                    return null;
                }
                    
            }

            return null;

        }

        public function eventStateUpdaterDetectorBeta($conexion)    //Revisa si en conexion se logro activar el event scheduler
        {
            $resultado = $conexion->query("SHOW VARIABLES LIKE 'event_scheduler'");

            if ($resultado == true)
            {
                $tupla = $resultado->fetch_assoc();

                return $tupla['Value'] === 'ON';
            }

            return false;
        }

        public function emergencySalaUpdater($conexion)  //Funcion de emergencia por si el evento de la BD no anda
        {
            $consulta = "UPDATE Sala SET Estado = 'FINALIZADA' WHERE Fecha < CURDATE() AND Estado = 'EN_PREPARACION'";
            return $conexion->query($consulta);
        }

    }

    


?>