<?php
#conexão com o banco
require "src/conexao-bd.php";

$sql1 = "SELECT * FROM produtos WHERE tipo = 'cafe' ";
#Foi removido da requisição dos items a ordenação -> ORDER BY preco";#errado no Café
#requisição
$statement = $pdo -> query($sql1);
#dados da requisição
$produtosCafe = $statement -> fetchAll(PDO::FETCH_ASSOC);
#array associativo dos dados


$sql2 = "SELECT * FROM produtos WHERE tipo = 'almoco' ";
#Foi removido da ordenação dos items a ordenação -> ORDER BY preco";#errado no Almoço
#requisição
$statement =$pdo -> query($sql2);
#dados da requisição
$produtosAlmoco = $statement -> fetchAll(PDO::FETCH_ASSOC);

//var_dump($produtosCafe);

//exit();

?>

<!doctype html>

<html lang="pt-br">



<head>

    <meta charset="UTF-8">

    <meta name="viewport"

        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/reset.css">
<!--Estilo -->
    <link rel="stylesheet" href="index.css">
<!--Estilo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

   <style>
  
  
.container-botao-novo{
    text-align: center;
    margin: 50px auto;
    width: 100%;
}

.botao-novo {
    background-color: #1F1007;
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 40px;
    text-decoration: none;
    border-radius: 20px;
    border: 2px solid #1F1007;
    transition: all 0.3s ease;
    display: inline-block;
}

.botao-novo:hover {
    background-color:rgba(118, 182, 14, 0.72);
    color: #EBC181;
}

.botao-excluir {
    background-color: #8B4513;
    color: #fff;
    padding: 6px 11px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s;
}

.botao-excluir {
    background-color: #dc3545;
}

.botao-excluir:hover {
    background-color: #c82333;
}

.container-filtros {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 20px;
    flex-wrap: wrap;
}

.filtro-status, .barra-pesquisa {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filtro-status label {
    color: #EBC181;
    font-weight: 500;
}

.filtro-status select, .barra-pesquisa input {
    padding: 8px;
    border-radius: 5px;
    border: 2px solid #EBC181;
    background-color: #1F1007;
    color: #FFFFFF;
    font-size: 14px;
}

.barra-pesquisa input {
    width: 300px;
}

.barra-pesquisa input::placeholder {
    color: #999;
}

.produto-escondido {
    display: none !important;
}

   </style>

    <title>Serenatto - Cardápio</title>

</head>



<body>
    
    <main>

        <section class="container-banner">

            <div class="container-texto-banner">

                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">

            </div>

            

        </section>
        
        <div class="container-filtros">
            <div class="filtro-status">
                <label for="filtro-status">Filtrar/Pesquisar:</label>
                <select id="filtro-status" onchange="filtrarProdutos()">
                    <option value="todos">Todos</option>
                    <option value="pendente">Pendente</option>
                    <option value="em_andamento">Em Andamento</option>
                    <option value="concluida">Concluída</option>
                </select>
            </div>
            
            <div class="barra-pesquisa">
                <input type="text" id="pesquisa" placeholder="Pesquisar por nome ou descrição..." 
                       onkeyup="filtrarProdutos()">
            </div>
        </div>

        <h2>Cardápio Digital</h2>
        

        <!-- café da manhã -->

        <section class="container-cafe-manha">

            <div class="container-cafe-manha-titulo">

                <h3>Opções para o Café</h3>

                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">

            </div>

            <div class="container-cafe-manha-produtos">

                <?php foreach ($produtosCafe as $cafe):?>

                    <div class="container-produto">

                        <div class="container-foto">

                            <img src="<?php echo $cafe['imagem'] ?>">

                        </div>

                        <p><?= $cafe['nome'] ?></p>

                        <p><?= $cafe['descriçao'] ?></p>

                        <p><?= "R$ " . $cafe['preco'] ?></p>

                        <p><?= $cafe['prioridade'] ?></p>

                        <p><?= $cafe['status'] ?></p>

                        <div class="container-botao">
                            <a href="editar-produto.php?id=<?= $cafe['id'] ?>" class="botao-editar">✎ Editar</a>
                            <a href="excluir-produto.php?id=<?= $cafe['id'] ?>" class="botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">🗑️ Excluir</a>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

        <!-- Almoço -->

        <section class="container-almoco">

        <div class="container-almoco-titulo">

                <h3>Opções para o Almoço</h3>

                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">

            </div>

            <div class="container-almoco-produtos">

                <?php foreach ($produtosAlmoco as $almoco): ?>

                    <div class="container-produto">

                        <div class="container-foto">

                            <img src="<?php echo $almoco['imagem'] ?>">

                        </div>

                        <p><?= $almoco['nome'] ?></p>

                        <p><?= $almoco['descriçao'] ?></p>

                        <p><?= "R$ " . $almoco['preco'] ?></p>

                        <p><?= $almoco['prioridade'] ?></p>

                        <p><?= $almoco['status'] ?></p>

                        <div class="container-botao">
                            <a href="editar-produto.php?id=<?= $almoco['id'] ?>" class="botao-editar">✎ Editar</a>
                            <a href="excluir-produto.php?id=<?= $almoco['id'] ?>" class="botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">🗑️ Excluir</a>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </section>
        <div class="container-botao-novo">
            <a href="criar-produto.php" class="botao-novo">+ Novo Produto</a>
        </div>

    </main>
    <script src="filtros.js"></script>
</body>



</html>
