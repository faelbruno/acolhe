<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Consultar todos os alunos, oficinas e datas de matrícula
$sql = "
    SELECT a.nome AS aluno_nome, o.nome AS oficina_nome, m.data_matricula
    FROM matriculas m
    JOIN alunos a ON m.id_aluno = a.id
    JOIN oficinas o ON m.id_oficina = o.id
    ORDER BY a.nome ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos Matriculados - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Alunos Matriculados</h2>

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
                        <td><?php echo htmlspecialchars($row['oficina_nome']); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row['data_matricula'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhum aluno matriculado encontrado.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
