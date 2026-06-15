<?php
    include_once "../objetos/chat.php";
    class chatBD
    {
        public function obtenerChat($idSala, $conexion)
        {
            $consulta = "SELECT * FROM Chat WHERE Id_sala = ? ORDER BY id_chat ASC";

            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("i", $idSala);
            $instruccion->execute();
            $result = $instruccion->get_result();
            
            $chat = [];

            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $chat[] = new Chat($row['id_chat'], $row['Id_sala'], $row['nickname'], $row['Contenido'], $row['fecha']);
                }
            }

            return $chat;
        }

        public function agregarMensaje($datosChat, $conexion)
        {
            $consulta = "INSERT INTO Chat (Id_sala, nickname, Contenido, fecha) VALUES (?, ?, ?, ?)";

            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("isss", $datosChat->getIdSala(), $datosChat->getNicknameEmisor(), $datosChat->getContenido(), $datosChat->getFechaHora());
            return $instruccion->execute();
        }
    
    }

?>