<?php
require 'mongo_connection.php'; // Conexão com o MongoDB

if (isset($_GET['id'])) {
    // Pegando o ID do livro
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Buscando o livro no banco de dados
    $livro = $livrosCollection->findOne(['_id' => $id]);
    
    if (!$livro) {
        echo "Livro não encontrado.";
        exit;
    }
    
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Coletando dados do formulário
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
        $ano_publicacao = $_POST['ano_publicacao'];
        $isbn = $_POST['isbn'];
        
        // Atualizando os dados no banco
        $updateResult = $livrosCollection->updateOne(
            ['_id' => $id],
            ['$set' => [
                'titulo' => $titulo,
                'autor' => $autor,
                'genero' => $genero,
                'ano_publicacao' => $ano_publicacao,
                'isbn' => $isbn
            ]]
        );
        
        if ($updateResult->getModifiedCount() > 0) {
            header('Location: livros.php'); // Redireciona de volta para a página de livros
            exit;
        } else {
            echo "Erro ao atualizar livro.";
        }
    }
} else {
    echo "ID não encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Web - Editar Livro</title>
    <link rel="icon" href="imagens/icone.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-edt-exc">
        <form method="POST">
            <h2 class="h2">Editar Livro</h2>
            <input type="hidden" name="id" value="<?= htmlspecialchars($livro['_id']); ?>">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($livro['titulo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($livro['autor']); ?>" required>
            </div>
            <div class="form-group">
                <label for="genero">Gênero</label>
                <input type="text" id="genero" name="genero" value="<?= htmlspecialchars($livro['genero']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ano_publicacao">Ano de Publicação:</label>
                <input type="number" id="ano_publicacao" name="ano_publicacao" min="1000" max="9999" value="<?= htmlspecialchars($livro['ano_publicacao']); ?>" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($livro['isbn']); ?>" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca Virtual. Todos os direitos reservados.</p>
    </footer>
</body>
</html>