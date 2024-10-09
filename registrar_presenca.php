<?php
session_start(); // Iniciar sessão

// Incluir arquivo de conexão
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Recuperar o id_unidade do professor logado
$usuario_id = $_SESSION['usuario_id'];
$sql_professor = "SELECT id_unidade FROM usuarios WHERE id = ?";
$stmt_professor = $conn->prepare($sql_professor);
$stmt_professor->bind_param("i", $usuario_id);
$stmt_professor->execute();
$result_professor = $stmt_professor->get_result();

if ($result_professor->num_rows > 0) {
    $professor = $result_professor->fetch_assoc();
    $id_unidade_professor = $professor['id_unidade'];
} else {
    die("Erro: Professor não encontrado.");
}

// Definir a data atual no formato "AAAA-MM-DD" e "DD-MM-AAAA"
$data_atual = date("Y-m-d"); // Para armazenar no banco
$data_exibir = date("d-m-Y"); // Para exibir no campo de leitura

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se a oficina foi selecionada
    if (isset($_POST['id_oficina'])) {
        $id_oficina = $_POST['id_oficina'];

        // Inserir a presença de cada aluno no banco de dados
        if (isset($_POST['presencas'])) {
            $presencas = $_POST['presencas']; // Array de presenças
            foreach ($presencas as $id_matricula => $status) {
                $sql = "INSERT INTO presencas (id_matricula, data, status) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $id_matricula, $data_atual, $status);
                $stmt->execute();
            }
            $mensagem = "Presenças registradas com sucesso!";
        }
    } else {
        die("Erro: Nenhuma oficina selecionada.");
    }
}

// Consultar os alunos da mesma unidade e oficina que o professor
$sql_alunos = "SELECT * FROM alunos WHERE id_unidade = ? AND oficina = ?";
$stmt_alunos = $conn->prepare($sql_alunos);
$stmt_alunos->bind_param("ii", $id_unidade_professor, $id_oficina);
$stmt_alunos->execute();
$result_alunos = $stmt_alunos->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presença - ACOLHE</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <div class="container">
        <h2>Registrar Presença</h2>
        <?php if (isset($mensagem)): ?>
            <p style="color:green;"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <label>Data da Presença:</label>
        <input type="text" value="<?php echo $data_exibir; ?>" readonly> <!-- Data atual em formato "DD-MM-AAAA" -->
        <input type="hidden" name="data_presenca" value="<?php echo $data_atual; ?>" id="data-presenca"> <!-- Campo escondido para armazenar a data no formato "AAAA-MM-DD" -->

        <form action="registrar_presenca.php" method="post">
            <input type="hidden" name="data_presenca" value="<?php echo $data_atual; ?>" id="data-presenca">
            <input type="hidden" name="id_oficina" value="<?php echo htmlspecialchars($id_oficina); ?>">

            <table>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Presença</th>
                </tr>
                <?php while ($aluno = $result_alunos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $aluno['nome']; ?></td>
                        <td>
                            <select name="presencas[<?php echo $aluno['id']; ?>]">
                                <option value="presente">Presente</option>
                                <option value="ausente">Ausente</option>
                                <option value="justificado">Justificado</option>
                            </select>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <button type="submit">Registrar Presença</button>
        </form>
    </div>
</body>
</html>
