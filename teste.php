<?php
include('verifica_acesso.php'); // Inclui o arquivo de verificação de acesso
include('conexao.php'); // Inclui o arquivo de conexão com o banco de dados

// Inicializar variáveis
$mensagem = '';
$data_presenca = '';
$id_oficina = '';
$presencas = [];

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_presenca = $_POST['data_presenca'];
    $id_oficina = $_POST['id_oficina'];
    
    // Obter as matrículas dos alunos para a oficina selecionada
    $sql_matriculas = "SELECT m.id, a.nome 
                       FROM matriculas m 
                       JOIN alunos a ON m.id_aluno = a.id 
                       WHERE m.id_oficina = ?";
    
    $stmt_matriculas = $conn->prepare($sql_matriculas);
    $stmt_matriculas->bind_param("i", $id_oficina);
    $stmt_matriculas->execute();
    $result_matriculas = $stmt_matriculas->get_result();
    
    // Processar as presenças
    while ($row = $result_matriculas->fetch_assoc()) {
        $id_matricula = $row['id'];
        $status = $_POST["presenca_{$id_matricula}"]; // 'Presente' ou 'Ausente'

        // Inserir a presença no banco de dados
        $sql_presenca = "INSERT INTO presencas (id_matricula, data, status) VALUES (?, ?, ?)";
        $stmt_presenca = $conn->prepare($sql_presenca);
        $stmt_presenca->bind_param("iss", $id_matricula, $data_presenca, $status);
        $stmt_presenca->execute();
    }
    
    $mensagem = "Presenças registradas com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presença</title>
</head>
<body>
    <h1>Registrar Presença</h1>
    
    <?php if ($mensagem): ?>
        <p style="color: green;"><?php echo $mensagem; ?></p>
    <?php endif; ?>
    
    <form action="registrar_presenca.php" method="post">
        <label for="data_presenca">Data da Presença:</label>
        <input type="date" name="data_presenca" id="data_presenca" required>

        <label for="id_oficina">Oficina:</label>
        <select name="id_oficina" id="id_oficina" onchange="this.form.submit()" required>
            <option value="">Selecione uma oficina</option>
            <?php
            // Obter todas as oficinas
            $sql_oficinas = "SELECT * FROM oficinas";
            $result_oficinas = $conn->query($sql_oficinas);

            while ($oficina = $result_oficinas->fetch_assoc()): ?>
                <option value="<?php echo $oficina['id']; ?>"><?php echo $oficina['nome']; ?></option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if (!empty($id_oficina)): ?>
        <h2>Registrar Presença para a Oficina</h2>
        <form action="registrar_presenca.php" method="post">
            <input type="hidden" name="data_presenca" value="<?php echo $data_presenca; ?>">
            <input type="hidden" name="id_oficina" value="<?php echo $id_oficina; ?>">

            <?php
            // Obter as matrículas para a oficina selecionada
            $sql_matriculas = "SELECT m.id, a.nome 
                               FROM matriculas m 
                               JOIN alunos a ON m.id_aluno = a.id 
                               WHERE m.id_oficina = ?";
            $stmt_matriculas = $conn->prepare($sql_matriculas);
            $stmt_matriculas->bind_param("i", $id_oficina);
            $stmt_matriculas->execute();
            $result_matriculas = $stmt_matriculas->get_result();

            while ($row = $result_matriculas->fetch_assoc()): ?>
                <div>
                    <label><?php echo $row['nome']; ?></label>
                    <select name="presenca_<?php echo $row['id']; ?>">
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
            <?php endwhile; ?>
            <button type="submit">Registrar Presenças</button>
        </form>
    <?php endif; ?>
</body>
</html>
