<?php
   $conexao = mysqli_connect("127.0.0.1", "root", "123456", "allan-db");
   if (mysqli_connect_errno()) {
      echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
   }else
      echo "Conectado com sucesso ao MySQL.";
?>
