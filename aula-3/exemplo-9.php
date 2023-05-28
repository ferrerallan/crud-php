<?php
  include 'exemplo-5.php';
  $id = 1;
  $exclusao = "DELETE FROM produto WHERE id = $id";
  mysqli_query($conexao, $exclusao);
?>
