<?php
require 'mongo_connection.php'; // Conexão com o MongoDB

if (isset($_GET['id'])) {
    // Pegando o ID do livro
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Excluindo o livro
    $result = $livrosCollection->deleteOne(['_id' => $id]);
    
    if ($result->getDeletedCount() > 0) {
        header('Location: livros.php'); // Redireciona de volta para a página de livros
        exit;
    } else {
        echo "Erro ao excluir livro.";
    }
} else {
    echo "ID não encontrado.";
}
?>