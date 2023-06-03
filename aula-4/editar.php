<?php
// Verificar se o ID está presente na URL
if (isset($_GET['id'])) {
  // Recuperar o ID do item a ser editado
  $id = $_GET['id'];

  // Incluir o arquivo de conexão
  include 'conexao.php';

  // Verificar se a conexão foi estabelecida com sucesso
  if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  // Verificar se os campos de nome e valor foram enviados. Na primeira vez não vai passar aqui, pq vem de metodo GET
  if (isset($_POST['nome']) && isset($_POST['valor'])) {
    // Recuperar os valores dos campos do formulário
    $novoNome = $_POST['nome'];
    $novoValor = $_POST['valor'];

    // Atualizar os valores do registro no banco de dados
    $sqlUpdate = "UPDATE produto SET nome = '$novoNome', valor = '$novoValor' WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
      // Fechar a conexão com o banco de dados
      $conn->close();

      // Redirecionar para a página "listagem.php"
      header("Location: listagem.php");
      exit;
    } else {
      echo "Erro ao atualizar o registro: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    exit;
  }

  // Consultar o banco de dados para obter os valores dos campos com base no ID
  $sql = "SELECT nome, valor FROM produto WHERE id = $id";
  $result = $conn->query($sql);

  // Verificar se a consulta retornou algum resultado
  if ($result->num_rows > 0) {
    // Obter os valores dos campos
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $valor = $row['valor'];
  } else {
    echo "<p>Erro: Item não encontrado.</p>";
    exit;
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
} else {
  echo "<p>Erro: ID não fornecido.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Editar</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Página de Edição</h1>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
      </div>
      <div class="form-group">
        <label for="valor">Valor:</label>
        <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="<?php echo $valor; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="listagem.php" class="btn btn-secondary">Voltar</a>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
