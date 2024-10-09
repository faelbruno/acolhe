<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar se uma data foi selecionada
$data_presenca = isset($_POST['data_presenca']) ? $_POST['data_presenca'] : date('Y-m-d');

// Consultar as presenças registradas para a data selecionada
$sql = "SELECT p.data, a.nome, p.status 
        FROM presencas p 
        JOIN alunos a ON p.id_matricula = a.id 
        WHERE p.data = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $data_presenca);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Presenças - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Listar Presenças</h2>
        
        <form action="listar_presencas.php" method="post">
            <label for="data_presenca">Selecione a data:</label>
            <input type="date" name="data_presenca" id="data_presenca" value="<?php echo $data_presenca; ?>">
            <button type="submit">Filtrar</button>
        </form>
        
        <table>
            <tr>
                <th>Data</th>
                <th>Nome do Aluno</th>
                <th>Status</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($presenca = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $presenca['data']; ?></td>
                        <td><?php echo $presenca['nome']; ?></td>
                        <td><?php echo $presenca['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhuma presença registrada para esta data.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
