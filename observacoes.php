<?php
session_start(); // Iniciar sessão

include('conexao.php'); 
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtém o id_matricula da URL
$id_matricula = isset($_GET['id_matricula']) ? intval($_GET['id_matricula']) : 0;

// Busca as observações para o aluno
$sql = "SELECT * FROM observacoes WHERE id_matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_matricula);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observações</title>
</head>
<body>
    <h1>Observações do Aluno</h1>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Comentário</th>
            </tr>
            <?php while ($observacao = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($observacao['data']); ?></td>
                    <td><?php echo htmlspecialchars($observacao['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($observacao['comentario']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Não há observações para este aluno.</p>
    <?php endif; ?>

    <a href="registrar_presenca.php">Voltar</a>

</body>
</html>

<?php
// Fecha a conexão
$stmt->close();
$conn->close();
?>
