<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $unidade = $_POST['unidade'];
    $atividades = implode(', ', $_POST['atividades']); // Convertendo array para string

    // Inserir aluno no banco de dados
    $sql = "INSERT INTO alunos (nome, unidade, atividades) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $unidade, $atividades);

    if ($stmt->execute()) {
        $mensagem = "Aluno cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar o aluno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Aluno</h2>
        <?php if (isset($mensagem)): ?>
            <p style="color:green;"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        
        <form action="cadastrar_aluno.php" method="post">
            <label for="nome">Nome do Aluno:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="unidade">Unidade:</label>
            <select name="unidade" id="unidade" required>
                <option value="">Selecione</option>
                <option value="Cuiabá">Cuiabá</option>
                <option value="Várzea Grande">Várzea Grande</option>
                <option value="Rondonópolis">Rondonópolis</option>
                <option value="Nova Olímpia">Nova Olímpia</option>
                <option value="Cáceres">Cáceres</option>
            </select>

            <label for="atividades">Atividades de Interesse:</label>
            <select name="atividades[]" id="atividades" multiple required>
                <option value="Atividade 1">Atividade 1</option>
                <option value="Atividade 2">Atividade 2</option>
                <option value="Atividade 3">Atividade 3</option>
                <option value="Atividade 4">Atividade 4</option>
                <option value="Atividade 5">Atividade 5</option>
            </select>

            <button type="submit">Cadastrar Aluno</button>
        </form>
    </div>
</body>
</html>
