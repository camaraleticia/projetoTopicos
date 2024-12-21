<?php
require 'mongo_connection.php'; // Conexão com o MongoDB

if (isset($_GET['id'])) {
    // Pegando o ID do autor
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Excluindo o autor
    $result = $autoresCollection->deleteOne(['_id' => $id]);
    
    if ($result->getDeletedCount() > 0) {
        header('Location: autores.php'); // Redireciona de volta para a página de autores
        exit;
    } else {
        echo "Erro ao excluir autor.";
    }
} else {
    echo "ID não encontrado.";
}
?>