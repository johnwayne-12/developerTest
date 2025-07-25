<?php

class RecursoController {
    public static function consumir() {
        global $pdo;
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['clube_id'], $input['recurso_id'], $input['valor_consumo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos.']);
            return;
        }

        $clube_id = $input['clube_id'];
        $recurso_id = $input['recurso_id'];
        $valor = floatval($input['valor_consumo']);

        $pdo->beginTransaction();
        try {
            $clube = $pdo->query("SELECT saldo_disponivel, clube FROM clubes WHERE id = $clube_id")->fetch();
            $recurso = $pdo->query("SELECT saldo_disponivel FROM recursos WHERE id = $recurso_id")->fetch();

            if (!$clube || !$recurso) {
                throw new Exception('Clube ou recurso não encontrado.');
            }

            if ($clube['saldo_disponivel'] < $valor) {
                http_response_code(400);
                echo json_encode(['error' => 'O saldo disponível do clube é insuficiente.']);
                return;
            }

            $novo_saldo_clube = $clube['saldo_disponivel'] - $valor;
            $novo_saldo_recurso = $recurso['saldo_disponivel'] - $valor;

            $pdo->exec("UPDATE clubes SET saldo_disponivel = $novo_saldo_clube WHERE id = $clube_id");
            $pdo->exec("UPDATE recursos SET saldo_disponivel = $novo_saldo_recurso WHERE id = $recurso_id");

            $pdo->commit();

            echo json_encode([
                'clube' => $clube['clube'],
                'saldo_anterior' => $clube['saldo_disponivel'],
                'saldo_atual' => $novo_saldo_clube
            ]);
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}