<?php
  include 'exemplo-5.php';
  $id = 1;
  $novoPreco = 9.99;
  $atualizacao = "UPDATE produto SET valor = $novoPreco WHERE id = $id";
  mysqli_query($conexao, $atualizacao);
?>
