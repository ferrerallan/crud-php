<?php
  include 'exemplo-5.php';
  $nome = "Produto A";
  $valor = 10.99;
  $insercao = "INSERT INTO produto (nome, valor) VALUES ('$nome', $valor)";
  mysqli_query($conexao, $insercao);
?>
