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
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $nome_pai = $_POST['nome_pai'];
    $nome_mae = $_POST['nome_mae'];
    $responsavel = $_POST['responsavel'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $id_unidade = $_POST['unidade'];
    $oficina = $_POST['oficina']; // Este valor deve existir na tabela oficinas

    // Inserir aluno no banco de dados
    $sql = "INSERT INTO alunos (nome, cpf, data_nascimento, sexo, nome_pai, nome_mae, responsavel, contato, endereco, complemento, id_unidade, oficina) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $nome, $cpf, $data_nascimento, $sexo, $nome_pai, $nome_mae, $responsavel, $contato, $endereco, $complemento, $id_unidade, $oficina);

    if ($stmt->execute()) {
        $mensagem = "Aluno cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar o aluno: " . $conn->error;
    }
}

// Carregar oficinas com base na unidade selecionada
if (isset($_POST['unidade'])) {
    $id_unidade = $_POST['unidade'];
    $sql_oficinas = "SELECT * FROM oficinas WHERE id_unidade = ?";
    $stmt_oficinas = $conn->prepare($sql_oficinas);
    $stmt_oficinas->bind_param("i", $id_unidade);
    $stmt_oficinas->execute();
    $result_oficinas = $stmt_oficinas->get_result();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
    <script>
        function loadOficinas() {
            var unidade = document.getElementById('unidade').value;
            var form = document.getElementById('cadastrar-aluno-form');
            form.action = 'cadastrar_aluno.php'; // Mude a ação para recarregar o formulário
            form.method = 'post';
            form.submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Aluno</h2>
        <?php if (isset($mensagem)): ?>
            <p style="color:green;"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        
        <form id="cadastrar-aluno-form" action="cadastrar_aluno.php" method="post">
            <label for="nome">Nome do Aluno:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" id="data_nascimento" required>

            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>

            <label for="nome_pai">Nome do Pai:</label>
            <input type="text" name="nome_pai" id="nome_pai">

            <label for="nome_mae">Nome da Mãe:</label>
            <input type="text" name="nome_mae" id="nome_mae">

            <label for="responsavel">Nome do Responsável:</label>
            <input type="text" name="responsavel" id="responsavel">

            <label for="contato">Número de Contato:</label>
            <input type="text" name="contato" id="contato">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" required>

            <label for="complemento">Complemento/Ponto de Referência:</label>
            <input type="text" name="complemento" id="complemento">

            <label for="unidade">Unidade:</label>
            <select name="unidade" id="unidade" required onchange="loadOficinas()">
                <option value="">Selecione</option>
                <option value="1">Cuiabá</option>
                <option value="2">Várzea Grande</option>
                <option value="3">Rondonópolis</option>
                <option value="4">Nova Olímpia</option>
                <option value="5">Cáceres</option>
            </select>

            <label for="oficina">Oficina:</label>
            <select name="oficina" id="oficina" required>
                <option value="">Selecione uma oficina</option>
                <?php if (isset($result_oficinas)): ?>
                    <?php while ($oficina = $result_oficinas->fetch_assoc()): ?>
                        <option value="<?php echo $oficina['id']; ?>"><?php echo $oficina['nome']; ?></option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>

            <button type="submit">Cadastrar Aluno</button>
        </form>
    </div>
</body>
</html>
