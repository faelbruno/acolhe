<?php
session_start(); // Iniciar sessão

include('conexao.php'); 
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Normalizar o tipo de usuário
$usuario_tipo = strtolower(trim($_SESSION['usuario_tipo']));

// Debug: Verifique os valores da sessão
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao ACOLHE!</h1>
        <p>Você está logado como: <strong><?php echo ucfirst($usuario_tipo); ?></strong></p>

        <?php if ($usuario_tipo == 'psicossocial'): ?>
            <h2>Ações Disponíveis</h2>
            <ul>
                <li><a href="cadastrar_aluno.php">Cadastrar Aluno</a></li>
            </ul>
        <?php elseif ($usuario_tipo == 'coordenador'): ?>
            <h2>Ações Disponíveis</h2>
            <ul>
                <li><a href="listar_presencas.php">Listar Presenças</a></li>
            </ul>
        <?php elseif ($usuario_tipo == 'professor'): ?>
            <h2>Ações Disponíveis</h2>
            <ul>
                <li><a href="registrar_presenca.php">Registrar Presença</a></li>
                <li><a href="listar_presencas.php">Listar Presenças</a></li>
            </ul>
        <?php else: ?>
            <p>Tipo de usuário desconhecido.</p>
        <?php endif; ?>

        <form action="logout.php" method="post">
            <button type="submit">Sair</button>
        </form>
        
    </div>
    <!-- OUTRO -->
    <?php

// Recuperar ID do professor logado
$usuario_id = $_SESSION['usuario_id'];

// Consultar as oficinas vinculadas ao professor
$sql_oficinas = "
    SELECT o.id, o.nome 
    FROM oficinas o 
    INNER JOIN professor_oficinas po ON o.id = po.id_oficina 
    WHERE po.id_professor = ?";
$stmt_oficinas = $conn->prepare($sql_oficinas);
$stmt_oficinas->bind_param("i", $usuario_id);
$stmt_oficinas->execute();
$result_oficinas = $stmt_oficinas->get_result();

// Exibir as oficinas em uma lista
?>

    <div class="container">
        <h2>Selecionar Oficina</h2>
        <form action="registrar_presenca.php" method="post">
            <label for="oficina">Escolha a Oficina:</label>
            <ul>
                <?php while ($oficina = $result_oficinas->fetch_assoc()): ?>
                    <li>
                        <input type="radio" name="id_oficina" value="<?php echo $oficina['id']; ?>" required>
                        <?php echo htmlspecialchars($oficina['nome']); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            <button type="submit">Selecionar Oficina</button>
        </form>
    </div>
</body>
</html>
