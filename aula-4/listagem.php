<!DOCTYPE html>
<html>
<head>
  <title>Página de Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- adicionando jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- adicionando Bootstrap CSS, biblioteca de icones -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- adicionando Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
  <script>
    function editarItem(id) {      
      // Redirecionar para a página de edição com o ID como parâmetro
      window.location.href = "editar.php?id=" + id;
    }
  </script>
</head>
<body>
  
<!-- 
Comentários explicativos para o modal:

<div class="modal fade" id="modal-info">
  Define um modal (caixa de diálogo) com o ID "modal-info".

  <div class="modal-dialog">
    Define a área de conteúdo do modal.

    <div class="modal-content">
      Envolve todo o conteúdo do modal.

      <div class="modal-header">
        Contém o cabeçalho do modal.

        <h4 class="modal-title">Detalhes do Produto</h4>
        Exibe o título do modal como "Detalhes do Produto".

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Botão de fechar que permite fechar o modal.
      </div>

      <div class="modal-body">
        Contém o corpo do modal.

        <p>ID: <span id="productId"></span></p>
        Parágrafo que exibe o ID do produto, onde o valor será preenchido dinamicamente usando JavaScript.

        <p>Nome: <span id="productName"></span></p>
        Parágrafo que exibe o nome do produto, onde o valor será preenchido dinamicamente usando JavaScript.

        <p>Valor: <span id="productValue"></span></p>
        Parágrafo que exibe o valor do produto, onde o valor será preenchido dinamicamente usando JavaScript.
      </div>

      <div class="modal-footer">
        Contém o rodapé do modal.

        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        Botão "Fechar" que permite fechar o modal.
      </div>
    </div>
  </div>
</div>
-->

<!--MODAL-->
<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detalhes do Produto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>ID: <span id="productId"></span></p>
        <p>Nome: <span id="productName"></span></p>
        <p>Valor: <span id="productValue"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--CONTAINER COM A TABELA-->
<div class="container">
  <h2>Lista de Produtos</h2>
  <div class="table-responsive">
    <!-- Botão para adicionar um novo produto -->
    <a href="inclusao.php" class="btn btn-primary">
      <i class="fa fa-plus"></i> Incluir
    </a>
    <!--efeito visual listrado -->
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col" style="width:10%">ID</th>
        <th scope="col" style="width:50%">Nome</th>
        <th scope="col" style="width:20%">Valor</th>
        <th scope="col" style="width:5%">Visualizar</th>
        <th scope="col" style="width:5%">Editar</th>
        <th scope="col" style="width:5%">Excluir</th>
      </tr>
    </thead>
      <tbody>
        <?php
        include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

        $sql = "SELECT * FROM produto"; // Consulta SQL para obter todos os produtos

        $result = $conn->query($sql); // Executa a consulta
        if ($conn->error) {
          die("Erro na consulta: " . $conn->error); // Se houver um erro na consulta, interrompe a execução do script
        }
        ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['valor']; ?></td>
            <td style="cursor: pointer;">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </td>
            <td>
              <a href="editar.php?id=<?php echo $row['id']; ?>">
                <i class="fa fa-edit">
                </i>
              </a>
            </td>
            <td>
              <a href="#" 
                   class="delete-btn" 
                   data-id="<?php echo $row['id']; ?>">
                  <i class="fa fa-trash"></i>
                </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<script>
$(document).ready(function(){ //espera ficar completamente carregado
  //Isso seleciona todos os elementos com a classe CSS "delete-btn" e atribui a eles um manipulador de evento de clique.
  $(".delete-btn").click(function(e){
    e.preventDefault(); //instruindo o navegador a não executar o comportamento padrão associado a esse evento
    // Obtém o ID do produto a ser excluído a partir do atributo 'data-id' do botão. O "this" se refere ao elemento atual que disparou o evento de clique.
    var productId = $(this).data('id'); 
    
    /*Exibe uma caixa de diálogo de confirmação ao usuário com a mensagem "Tem certeza de que deseja excluir este produto?".
    A função "confirm" retorna um valor booleano: "true" se o usuário clicar em "OK" e "false" se o usuário clicar em "Cancelar".*/
    var userConfirmation = confirm('Tem certeza de que deseja excluir este produto?'); // Exibe uma mensagem de confirmação ao usuário
    if(userConfirmation){
      window.location.href = "excluir.php?id=" + productId; // Se confirmado, redireciona para a página "excluir.php" passando o ID do produto como parâmetro
    }
  });

  $(".fa-eye").click(function(){    
    var $row = $(this).closest("tr"); // Obtém a linha (tr) mais próxima do ícone de visualização clicado
    var productId = $row.find("td:nth-child(1)").text(); // Obtém o ID do produto da primeira célula (td) da linha
    var productName = $row.find("td:nth-child(2)").text(); // Obtém o nome do produto da segunda célula (td) da linha
    var productValue = $row.find("td:nth-child(3)").text(); // Obtém o valor do produto da terceira célula (td) da linha

    $("#productId").text(productId); // Define o ID do produto no elemento com o ID "productId"
    $("#productName").text(productName); // Define o nome do produto no elemento com o ID "productName"
    $("#productValue").text(productValue); // Define o valor do produto no elemento com o ID "productValue"

    $("#modal-info").modal(); // Abre o modal com os detalhes do produto
  });
});
</script>
</body>
</html>
