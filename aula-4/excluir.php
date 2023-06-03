<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if (!isset($_GET['id'])) {
  die("Erro: ID não especificado."); // Interrompe a execução do script se nenhum ID foi especificado
}

$id = $_GET['id']; // Obtém o ID do produto a partir do parâmetro na URL

$sql = "DELETE FROM produto WHERE id = ?"; // Consulta SQL para excluir o produto com o ID especificado

$stmt = $conn->prepare($sql); // Prepara a consulta SQL
$stmt->bind_param("i", $id); // Vincula o ID à consulta SQL

if ($stmt->execute()) { // Executa a consulta SQL
  header("Location: listagem.php"); // Redireciona o usuário de volta para a página principal se a exclusão for bem-sucedida
} else {
  die("Erro ao excluir o produto: " . $conn->error); // Se houver um erro ao excluir o produto, interrompe a execução do script
}
?>
