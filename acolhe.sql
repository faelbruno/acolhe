<?php
// Conectar ao banco de dados
require 'conexao.php'; // certifique-se de que o arquivo de conexão está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $id_matricula = intval($_POST['id_matricula']); // ID da matrícula do aluno
    $data_presenca = $_POST['data_presenca']; // Data da presença
    $status_presenca = $_POST['status_presenca']; // Status da presença

    // Validar dados
    if (empty($id_matricula) || empty($data_presenca) || empty($status_presenca)) {
        die('Todos os campos são obrigatórios!');
    }

    // Verifica se a presença já foi registrada para a data
    $stmt = $conn->prepare("SELECT * FROM presencas WHERE id_matricula = ? AND data = ?");
    $stmt->bind_param("is", $id_matricula, $data_presenca);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('Presença já registrada para essa data.');
    }

    // Inserir nova presença
    $stmt = $conn->prepare("INSERT INTO presencas (id_matricula, data, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id_matricula, $data_presenca, $status_presenca);

    if ($stmt->execute()) {
        echo "Presença registrada com sucesso!";
    } else {
        echo "Erro ao registrar presença: " . $stmt->error;
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}

// Obter todas as matrículas para exibir no formulário
$result_matriculas = $conn->query("SELECT m.id, a.nome FROM matriculas m JOIN alunos a ON m.id_aluno = a.id");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presença</title>
</head>
<body>
    <h1>Registrar Presença</h1>
    <form method="POST" action="">
        <label for="id_matricula">Selecionar Aluno:</label>
        <select name="id_matricula" id="id_matricula" required>
            <option value="">Selecione um aluno</option>
            <?php while ($row = $result_matriculas->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
                <a href='observacoes.php?id_matricula={$aluno['id']}'>Observações</a>
            <?php endwhile; ?>
        </select>

        <label for="data_presenca">Data:</label>
        <input type="date" name="data_presenca" id="data_presenca" required>

        <label for="status_presenca">Status:</label>
        <select name="status_presenca" id="status_presenca" required>
            <option value="Presente">Presente</option>
            <option value="Ausente">Ausente</option>
        </select>

        <button type="submit">Registrar Presença</button>
    </form>
</body>
</html>
