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
$usuario_tipo = strtolower(trim($_SESSION['usuario_tipo']));
$id_oficina = isset($_GET['id_oficina']) ? $_GET['id_oficina'] : null;
if (!$id_oficina) {
    die("Erro: A oficina não foi selecionada.");
}

// Consulta para buscar o nome da oficina
$sql_oficina = "SELECT nome FROM oficinas WHERE id = ?";
$stmt_oficina = $conn->prepare($sql_oficina);
$stmt_oficina->bind_param("i", $id_oficina);
$stmt_oficina->execute();
$result_oficina = $stmt_oficina->get_result();
// Verificar se a oficina foi encontrada
if ($result_oficina->num_rows > 0) {
    $oficina = $result_oficina->fetch_assoc();
    $nome_oficina = $oficina['nome']; // Armazena o nome da oficina
} else {
    die("Erro: Oficina não encontrada.");
}

// Consultar os alunos da oficina
//$sql_alunos = "SELECT * FROM alunos WHERE oficina = ?";
$sql_alunos = "SELECT nome, id, foto FROM alunos WHERE oficina = ?";

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
    <img src="lib/img/logo-mini.png" alt="Logo Acolhe" />
        <h1>Bem-vindo ao ACOLHE!</h1>
        <p>Você está logado como: <strong><?php echo ucfirst($usuario_tipo); ?></strong></p>
        
        <h2>Registro de Presença dos Alunos da <?php echo htmlspecialchars($nome_oficina); ?></h2>
        
        <form action="registrar_presenca.php?id_oficina=<?php echo $id_oficina; ?>" method="post">
            <input type="hidden" name="data_presenca" value="<?php echo date("Y-m-d"); ?>"> <!-- Data atual -->

            <div class="alunos-container">
    <?php while ($aluno = $result_alunos->fetch_assoc()): ?>
        <div class="aluno-card">
            <div class="aluno-foto">
                <?php if (!empty($aluno['foto'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($aluno['foto']); ?>" alt="Foto do Aluno" width="100" height="100">
                <?php else: ?>
                    <img src="lib/img/avatar.jpg" alt="Aluno sem foto" width="100" height="100">
                <?php endif; ?>
            </div>
            <div class="aluno-nome">
                <?php echo htmlspecialchars($aluno['nome']); ?>
            </div>
            <div class="aluno-presenca">
                <select class="tamanho" name="presencas[<?php echo $aluno['id']; ?>]">
                    <option value="">Selecione</option>
                    <option value="presente">Presente</option>
                    <option value="ausente">Ausente</option>
                    <option value="justificado">Justificado</option>
                </select>
                <a class="tamanho" href="observacoes.php?id_matricula=<?php echo $aluno['id']; ?>">Anotações</a>
            </div>
            
        </div>
    <?php endwhile; ?>
</div>
<button type="submit">Registrar Presença</button>
        </form>
    </div>
</body>
</html>
