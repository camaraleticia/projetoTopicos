<?php
require 'mongo_connection.php'; // Conexão com o MongoDB

if (isset($_GET['id'])) {
    // Pegando o ID do autor
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Buscando o autor no banco de dados
    $autor = $autoresCollection->findOne(['_id' => $id]);
    
    if (!$autor) {
        echo "Autor não encontrado.";
        exit;
    }
    
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Coletando dados do formulário
        $nome = $_POST['nome'];
        $nacionalidade = $_POST['nacionalidade'];
        $data_nascimento = $_POST['data_nascimento'];
        
        // Atualizando os dados no banco
        $updateResult = $autoresCollection->updateOne(
            ['_id' => $id],
            ['$set' => [
                'nome' => $nome,
                'nacionalidade' => $nacionalidade,
                'data_nascimento' => $data_nascimento
            ]]
        );
        
        if ($updateResult->getModifiedCount() > 0) {
            header('Location: autores.php'); // Redireciona de volta para a página de autores
            exit;
        } else {
            echo "Erro ao atualizar autor.";
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
    <title>Biblioteca Web - Editar Autor</title>
    <link rel="icon" href="imagens/icone.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-edt-exc">
        <form method="POST">
            <h2 class="h2">Editar Autor</h2>
            <input type="hidden" name="id" value="<?= htmlspecialchars($autor['_id']); ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($autor['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nacionalidade">Nacionalidade</label>
                <input type="text" id="nacionalidade" name="nacionalidade" value="<?= htmlspecialchars($autor['nacionalidade']); ?>" required>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($autor['data_nascimento']); ?>" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca Virtual. Todos os direitos reservados.</p>
    </footer>
</body>
</html>