<?php

class ClubeController {
    public static function listar() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, clube, saldo_disponivel FROM clubes");
        echo json_encode($stmt->fetchAll());
    }

    public static function cadastrar() {
        global $pdo;
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['clube']) || !isset($input['saldo_disponivel'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos.']);
            return;
        }

        $sql = "INSERT INTO clubes (clube, saldo_disponivel) VALUES (:clube, :saldo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':clube' => $input['clube'],
            ':saldo' => $input['saldo_disponivel']
        ]);
        echo json_encode(['success' => true]);
    }
}