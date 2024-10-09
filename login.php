<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['usuario']; // Aqui deve ser 'email'
    $senha = $_POST['senha'];

    // Consultar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_tipo'] = $row['tipo']; // Pode ser 'Psicossocial', 'Coordenador' ou 'Professor'
        header("Location: index.php"); // Redirecionar para a página inicial
        exit();
    } else {
        $mensagem = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($mensagem)): ?>
            <p style="color:red;"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        
        <form action="login.php" method="post">
            <label for="usuario">Email:</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
