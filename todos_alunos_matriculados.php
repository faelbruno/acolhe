<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Consultar todos os alunos e suas matrículas em oficinas (incluindo alunos sem matrícula)
$sql = "
    SELECT a.nome AS aluno_nome, o.nome AS oficina_nome, m.data_matricula
    FROM alunos a
    LEFT JOIN matriculas m ON a.id = m.id_aluno
    LEFT JOIN oficinas o ON m.id_oficina = o.id
    ORDER BY a.nome ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Alunos Matriculados - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Todos os Alunos Matriculados</h2>

        <table>
            <tr>
                <th>Nome do Aluno</th>
                <th>Oficina</th>
                <th>Data de Matrícula</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['aluno_nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['oficina_nome']) ?: 'Nenhuma'; ?></td>
                        <td><?php echo isset($row['data_matricula']) ? date("d-m-Y", strtotime($row['data_matricula'])) : 'N/A'; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhum aluno encontrado.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
