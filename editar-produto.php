<?php
require "src/conexao-bd.php";
#conecta com o banco

if (isset($_GET['id'])) {#isset verifica se a variável não é nula
    $id = $_GET['id'];
    #POST: Para adicionar tarefas (Create).
    #GET: Para listar e visualizar tarefas (Read).
    #PUT: Para editar tarefas (Update).
    #DELETE: Para excluir tarefas (Delete).
    $sql = "SELECT * FROM produtos WHERE id = ?";#faz a requisição de todos os dados da tabela
    $stmt = $pdo->prepare($sql);#prepara para consulta segura
    $stmt->execute([$id]);#executa a busca pelo id específico
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    // Processamento da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $imagem = $_FILES['imagem']['name'];
        $caminho_imagem = "img/" . $imagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
        
        $sql = "UPDATE produtos SET nome = ?, descriçao = ?, preco = ?, imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $caminho_imagem, $id]);
    } else {
        $sql = "UPDATE produtos SET nome = ?, descriçao = ?, preco = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $id]);
    }
    
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <title>Serenatto - Editar Produto</title>
</head>
<body>
    <main>
        <section class="container-admin-banner">
            <img src="img/logo-serenatto.png" class="logo-admin" alt="logo-serenatto">
            <h1>Editar Produto</h1>
        </section>
        <section class="container-form">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= $produto['nome'] ?>" required>
                
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" value="<?= $produto['descriçao'] ?>" required>
                
                <label for="preco">Preço</label>
                <input type="number" id="preco" name="preco" step="0.01" value="<?= $produto['preco'] ?>" required>
                
                <label for="imagem">Imagem</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
                
                <div class="container-botoes">
                    <button type="submit" class="botao-cadastrar">Salvar</button>
                    <a href="index.php" class="botao-voltar">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html> 