<?php
session_start(); // Iniciar a sessão

// Incluir o arquivo de conexão com o banco de dados
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Recuperar o id da oficina
$id_oficina = isset($_GET['id_oficina']) ? $_GET['id_oficina'] : null;
if (!$id_oficina) {
    die("Erro: A oficina não foi selecionada.");
}

// Consultar os alunos da oficina
$sql_alunos = "SELECT * FROM alunos WHERE oficina = ?";
$stmt_alunos = $conn->prepare($sql_alunos);
$stmt_alunos->bind_param("i", $id_oficina);
$stmt_alunos->execute();
$result_alunos = $stmt_alunos->get_result();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['data_presenca']) && isset($_POST['presencas'])) {
        $data_presenca = $_POST['data_presenca'];
        $presencas = $_POST['presencas']; // Array de presenças
        
        // Preparar a inserção no banco de dados
        $sql_presenca = "INSERT INTO presencas (id_matricula, data, status) VALUES (?, ?, ?)";
        $stmt_presenca = $conn->prepare($sql_presenca);
        
        if ($stmt_presenca === false) {
            die("Erro ao preparar a declaração: " . $conn->error);
        }

        // Iterar sobre os alunos e registrar as presenças
        foreach ($presencas as $id_matricula => $status) {
            // Verificar se o status não está vazio antes de inserir
            if (!empty($status)) {
                $stmt_presenca->bind_param("iss", $id_matricula, $data_presenca, $status);
                if (!$stmt_presenca->execute()) {
                    echo "Erro ao registrar presença do aluno ID $id_matricula: " . $stmt_presenca->error . "<br>";
                }
            } else {
                echo "Status vazio para o aluno ID $id_matricula.<br>";
            }
        }

        $stmt_presenca->close(); // Fecha a declaração
        $mensagem = "Presenças registradas com sucesso!";
    } else {
        $mensagem = "Erro: Dados de presença não recebidos.";
    }
}

// Para mostrar a mensagem de sucesso
if (isset($mensagem)) {
    echo "<p style='color: green;'>$mensagem</p>";
}

// Exibir a lista de alunos
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presença</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Presença</h2>
        <form action="registrar_presenca.php?id_oficina=<?php echo $id_oficina; ?>" method="post">
            <input type="hidden" name="data_presenca" value="<?php echo date("Y-m-d"); ?>"> <!-- Data atual -->

            <table>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Presença</th>
                </tr>
                <?php while ($aluno = $result_alunos->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
            <td>
                <select name="presencas[<?php echo $aluno['id']; ?>]">
                    <option value="">Selecione</option>
                    <option value="presente">Presente</option>
                    <option value="ausente">Ausente</option>
                    <option value="justificado">Justificado</option>
                </select>
            </td>
            <td>
                <a href="observacoes.php?id_matricula=<?php echo $aluno['id']; ?>">Observações</a> <!-- Correção no link -->
            </td>
        </tr>
    <?php endwhile; ?>
            </table>
            <button type="submit">Registrar Presença</button>
        </form>
    </div>
</body>
</html>
