<?php
    include_once "../../objetos/chat.php";
    class chatBD
    {
        public function obtenerChat($idSala, $conexion)
        {
            $consulta = "SELECT * FROM Chat WHERE idSala = ?";

            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("i", $idSala);
            $instruccion->execute();
            $result = $instruccion->get_result();
            
            $chat = null;

            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $chat = new Chat($row['id_chat'], $row['Id_sala'], $row['nickname'], $row['Contenido'], $row['fecha']);
                }
            }

            return $chat;
        }
    
    }

?>