<?php
class ResultadoModelo {

    // Aquí sacamos el último resultado del usuario para ver en qué casa quedó.
    public function obtenerResultadoUsuario($pdo, $idUsuario) {
        $stmt = $pdo->prepare("
            SELECT r.*, c.id_casa, c.nombre_casa, c.descripcion
            FROM resultados r
            JOIN casas c ON r.id_casa = c.id_casa
            WHERE r.id_usuario = ?
            ORDER BY r.fecha DESC
            LIMIT 1
        ");
        $stmt->execute([$idUsuario]);
        return $stmt->fetch();
    }

    // Aquí guardamos un nuevo resultado en la base de datos si el usuario nunca lo hizo antes.
    public function insertarResultado($pdo, $idUsuario, $idCasa) {
        $stmt = $pdo->prepare("
            INSERT INTO resultados (id_usuario, id_casa, fecha)
            VALUES (?, ?, NOW())
        ");
        return $stmt->execute([$idUsuario, $idCasa]);
    }

    // Aquí actualizamos el resultado del usuario si ya había hecho el test antes.
    public function actualizarResultado($pdo, $idUsuario, $idCasa) {
        $stmt = $pdo->prepare("
            UPDATE resultados 
            SET id_casa = ?, fecha = NOW()
            WHERE id_usuario = ?
        ");
        return $stmt->execute([$idCasa, $idUsuario]);
    }

     // Aquí sacamos los últimos resultados de todos los usuarios para hacer el ranking.
    public function ultimoResultadoPorUsuario($pdo) {
        $sql = "
            SELECT 
                r.fecha,
                u.nombre AS usuario,
                c.nombre_casa,
                r.id_casa
            FROM resultados r
            JOIN usuarios u ON r.id_usuario = u.id_usuario
            JOIN casas c ON r.id_casa = c.id_casa
            WHERE r.fecha = (
                SELECT MAX(r2.fecha)
                FROM resultados r2
                WHERE r2.id_usuario = r.id_usuario
            )
            ORDER BY r.fecha DESC
        ";

        return $pdo->query($sql)->fetchAll();
    }
}
