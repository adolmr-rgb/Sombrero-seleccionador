<?php
class UsuarioModelo {

    // Buscar usuario por nombre
    public function buscarPorUsuario($pdo, $nombre) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $stmt->execute([$nombre]);
        return $stmt->fetch();
    }

    // Crear un nuevo usuario
    public function crear($pdo, $nombre, $passwordHash) {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, password) VALUES (?, ?)");
        return $stmt->execute([$nombre, $passwordHash]);
    }
}
