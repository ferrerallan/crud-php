<!DOCTYPE html>
<html>
<head>
  <title>Inclusão de Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      background-color: #343a40;
      color: #fff;
    }
    .form-control {
      background-color: #495057;
      color: #fff;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Incluir Produto</h2>

  <form action="salvar.php" method="post">
    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto">
    </div>
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="number" step="0.01" class="form-control" id="valor" placeholder="Digite o valor do produto" name="valor" value="<?php echo $valor; ?>" required>
    </div>
    <input type="hidden" name="operacao" value="inserir">
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>
</body>
</html>
