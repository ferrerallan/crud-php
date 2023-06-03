<!-- 
Explicações dos itens do código PHP:

class="delete-btn":
  Essa classe é atribuída a um elemento HTML (geralmente um botão) para indicar que ele possui a função de exclusão de um item.

href="editar.php?id=":
  É um link que redireciona para a página "editar.php", passando o parâmetro "id" na URL para identificar qual item deve ser editado.

style="cursor: pointer;":
  Define o estilo do cursor quando o mouse é passado sobre o elemento como um ponteiro, indicando que ele é clicável.

<i class="fa fa-eye" aria-hidden="true"></i>:
  É um ícone visual, representado por uma tag <i> com a classe CSS "fa fa-eye", que geralmente é usada para representar a ação de visualizar um item.

aria-hidden="true":
  Define se o elemento deve ser oculto ou não para as tecnologias assistivas, como leitores de tela. Quando definido como "true", o elemento não é lido pelos leitores de tela.

fetch_assoc():
  É um método usado para obter a próxima linha do resultado de uma consulta SQL como um array associativo, onde as colunas são acessadas pelos seus nomes.

$result = $conn->query($sql):
  Executa uma consulta SQL na conexão com o banco de dados e atribui o resultado à variável $result.

if ($conn->error):
  Verifica se houve um erro na execução da consulta anterior e executa o código dentro do bloco "if" se houver um erro.

class="table-responsive":
  Essa classe é atribuída a um elemento HTML (geralmente uma div) para torná-lo responsivo, permitindo que seu conteúdo se ajuste ao tamanho da tela.

class="container":
  Essa classe é atribuída a um elemento HTML (geralmente uma div) para aplicar estilos de formatação do Bootstrap, como espaçamento e largura.

<div class="modal fade" id="myModal">:
  É um elemento HTML usado para criar um modal (caixa de diálogo) com um ID único para referenciá-lo posteriormente.

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">:
  É um link que importa a biblioteca Font Awesome para o documento HTML, permitindo o uso de ícones personalizados em elementos HTML.
-->


<!DOCTYPE html>
<html>
<head>
  <title>Página de Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- adicionando jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- adicionando Bootstrap CSS -->
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

<div class="modal fade" id="myModal">
  Define um modal (caixa de diálogo) com o ID "myModal".

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
<div class="modal fade" id="myModal">
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
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
            <td>R$ <?php echo number_format($row['valor'], 2, '.', ','); ?></td>
            <td style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true"></i></td>
            <td><a href="editar.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a></td>
            <td><a href="#" 
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
$(document).ready(function(){
  //Isso seleciona todos os elementos com a classe CSS "delete-btn" e atribui a eles um manipulador de evento de clique.
  $(".delete-btn").click(function(e){
    e.preventDefault();
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

    $("#myModal").modal(); // Abre o modal com os detalhes do produto
  });
});
</script>
</body>
</html>
