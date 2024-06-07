<?php
  include 'exemplo-5.php';
  $nome = "Master System";
  $valor = 400;
  $insercao = "INSERT INTO produto (nome, valor) VALUES ('$nome', $valor)";
  mysqli_query($conexao, $insercao);
?>
