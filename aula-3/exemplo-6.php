<?php
   include 'exemplo-5.php';
   $consulta = "SELECT * FROM produto";
   $resultado = mysqli_query($conexao, $consulta);

   while ($produto = mysqli_fetch_assoc($resultado)) {
      echo $produto['nome'] . " - R$" . $produto['valor'] . "<br>";
   }
?>
