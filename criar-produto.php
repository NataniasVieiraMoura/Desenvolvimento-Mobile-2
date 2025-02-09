<?php
require_once 'src/conexao-bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $data_vencimento = $_POST['data_vencimento'];
    $status = $_POST['status'];
    $prioridade = $_POST['prioridade'];

    // Processamento da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $imagem = $_FILES['imagem']['name'];
        $caminho_imagem = "img/" . $imagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
    }

    $sql = "INSERT INTO produtos (nome, descriçao, preco, tipo, imagem, data_vencimento, status, prioridade) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $preco, $tipo, $caminho_imagem, $data_vencimento, $status, $prioridade]);

    if ($stmt) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
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
    <title>Serenatto - Criar Produto</title>
</head>
<body>
    <main>
        <section class="container-admin-banner">
            <img src="img/logo-serenatto.png" class="logo-admin" alt="logo-serenatto">
            <h1>Criar Novo Produto</h1>
        </section>
        <section class="container-form">
            <form method="POST" enctype="multipart/form-data">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>
                
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" required>
                    <option value="cafe">Café</option>
                    <option value="almoco">Almoço</option>
                </select>

                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required>

                <label for="preco">Preço</label>
                <input type="number" id="preco" name="preco" step="0.01" required>

                <label for="imagem">Imagem</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" required>

                <label for="data_vencimento">Data de Vencimento</label>
                <input type="date" id="data_vencimento" name="data_vencimento" required>

                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="pendente">Pendente</option>
                    <option value="em_andamento">Em Andamento</option>
                    <option value="concluida">Concluída</option>
                </select>

                <label for="prioridade">Prioridade</label>
                <select name="prioridade" id="prioridade" required>
                    <option value="baixa">Baixa</option>
                    <option value="media">Média</option>
                    <option value="alta">Alta</option>
                </select>

                <div class="container-botoes">
                    <button type="submit" class="botao-cadastrar">Cadastrar</button>
                    <a href="index.php" class="botao-voltar">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html> 