<?php
session_start(); // Iniciar a sessão

include('conexao.php'); 

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Recuperar dados do usuário
$usuario_id = $_SESSION['usuario_id'];
$usuario_tipo = strtolower(trim($_SESSION['usuario_tipo']));

// Recuperar unidade do usuário
$sql_unidade = "SELECT id_unidade FROM usuarios WHERE id = ?";
$stmt_unidade = $conn->prepare($sql_unidade);
$stmt_unidade->bind_param("i", $usuario_id);
$stmt_unidade->execute();
$result_unidade = $stmt_unidade->get_result();
$unidade = $result_unidade->fetch_assoc();

// Consultar avisos da unidade
$sql_avisos_unidade = "SELECT * FROM avisos WHERE id_unidade = ?";
$stmt_avisos_unidade = $conn->prepare($sql_avisos_unidade);
$stmt_avisos_unidade->bind_param("i", $unidade['id_unidade']);
$stmt_avisos_unidade->execute();
$result_avisos_unidade = $stmt_avisos_unidade->get_result();

// Consultar avisos gerais
$sql_avisos_gerais = "SELECT * FROM avisos WHERE id_unidade IS NULL";
$result_avisos_gerais = $conn->query($sql_avisos_gerais);

// Consultar oficinas vinculadas ao professor
$sql_oficinas = "
    SELECT o.id, o.nome 
    FROM oficinas o 
    INNER JOIN professor_oficinas po ON o.id = po.id_oficina 
    WHERE po.id_professor = ?";
$stmt_oficinas = $conn->prepare($sql_oficinas);
$stmt_oficinas->bind_param("i", $usuario_id);
$stmt_oficinas->execute();
$result_oficinas = $stmt_oficinas->get_result();

// Consultar aniversariantes das oficinas
$sql_aniversariantes = "
    SELECT a.nome, a.data_nascimento, o.nome AS nome_oficina
    FROM alunos a 
    INNER JOIN oficinas o ON a.oficina = o.id
    WHERE o.id IN (SELECT id_oficina FROM professor_oficinas WHERE id_professor = ?) 
    AND MONTH(a.data_nascimento) = MONTH(CURDATE())";
$stmt_aniversariantes = $conn->prepare($sql_aniversariantes);
$stmt_aniversariantes->bind_param("i", $usuario_id);
$stmt_aniversariantes->execute();
$result_aniversariantes = $stmt_aniversariantes->get_result();
?>


<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
       
    </style>
</head>
<body style="background:#D2E9FF;">
    <div class="container" style="background:#fff; font-family: Roboto,Helvetica Neue,sans-serif;">
        <img src="lib/img/logo-mini.png" alt="Logo Acolhe" />
        <h1>Bem-vindo ao ACOLHE!</h1>
        <p>Você está logado como: <strong><?php echo ucfirst($usuario_tipo); ?></strong></p>

        <?php if ($usuario_tipo == 'professor'): ?>
            <h2>Oficinas</h2>
            <div class="oficinas">
                <?php while ($oficina = $result_oficinas->fetch_assoc()): ?>
                    <div class="oficina">
                        <a href="registrar_presenca.php?id_oficina=<?php echo $oficina['id']; ?>">
                        <img src="lib/img/<?php echo $oficina['id']; ?>.png" alt="Imagem da Oficina">
                            <p><?php echo htmlspecialchars($oficina['nome']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <div class="avisos">
            <h2>Avisos Gerais</h2>
            <?php if ($result_avisos_gerais && $result_avisos_gerais->num_rows > 0): ?>
                <ul>
                    <?php while ($aviso = $result_avisos_gerais->fetch_assoc()): ?>
                        <li><strong><?php echo htmlspecialchars($aviso['titulo']); ?>:</strong> <?php echo htmlspecialchars($aviso['mensagem']); ?> (<?php echo $aviso['data_aviso']; ?>)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Não há avisos gerais disponíveis.</p>
            <?php endif; ?>
        </div>  
        <div class="avisos-aniversariantes">

        <div class="avisos">
            <h2>Avisos da Unidade</h2>
            <?php if (isset($result_avisos_unidade) && $result_avisos_unidade->num_rows > 0): ?>
                <ul>
                    <?php while ($aviso = $result_avisos_unidade->fetch_assoc()): ?>
                        <li><strong><?php echo htmlspecialchars($aviso['titulo']); ?>:</strong> <?php echo htmlspecialchars($aviso['mensagem']); ?> (<?php echo $aviso['data_aviso']; ?>)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Não há avisos disponíveis para esta unidade.</p>
            <?php endif; ?>
        </div>

        <div class="aniversariantes">
            <h2>Aniversariantes do Mês</h2>
            <?php if ($result_aniversariantes && $result_aniversariantes->num_rows > 0): ?>
                <ul>
                    <?php while ($aniversariante = $result_aniversariantes->fetch_assoc()): ?>
                        <li><strong><?php echo htmlspecialchars($aniversariante['nome']); ?></strong> - Oficina: <?php echo htmlspecialchars($aniversariante['nome_oficina']); ?> - Data de Nascimento: <?php echo date('d/m', strtotime($aniversariante['data_nascimento'])); ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Não há aniversariantes neste mês.</p>
            <?php endif; ?>
        </div>
            </div>

        <!-- Botão flutuante para falar com o suporte -->
        <div class="btn-suporte">
            <a href="suporte.php" style="color: white;">Suporte</a>
        </div>
    </div>
</body>
</html>
