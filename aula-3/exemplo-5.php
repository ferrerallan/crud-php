<?php
   $server_host = "db-ads.c8bqy6anulng.sa-east-1.rds.amazonaws.com";
   $server_user = "admin";
   $server_password = "Unimar-ads-2023";
   $server_database = "minha_base";
   //$conexao = mysqli_connect("127.0.0.1", "root", "123456", "allan-db");
   $conexao = mysqli_connect("db-ads.c8bqy6anulng.sa-east-1.rds.amazonaws.com", "admin", "Unimar-ads-2023", "minha_base");
   if (mysqli_connect_errno()) {
      echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
   }else
      echo "Conectado com sucesso ao MySQL.";
?>
