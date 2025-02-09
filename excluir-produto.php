<?php
require_once 'src/conexao-bd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    if ($stmt) {
        header("Location: index.php");
        exit();
    }
}

header("Location: index.php");
exit(); 