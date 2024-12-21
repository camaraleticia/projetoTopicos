<?php
require 'mongo_connection.php';  // Inclui a conexão com o MongoDB

if (isset($_POST['submit_livro'])) {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $isbn = $_POST['isbn'];

    // Insere o livro na coleção 'livros'
    $result = $livrosCollection->insertOne([
        'titulo' => $titulo,
        'autor' => $autor,
        'genero' => $genero,
        'ano_publicacao' => $ano_publicacao,
        'isbn' => $isbn
    ]);

    // Verifica se o livro foi inserido corretamente
    if ($result->getInsertedCount() == 1) {
        echo "Livro cadastrado com sucesso!";
    }

    // Redireciona para a página de livros após o cadastro
    header('Location: livros.php');
    exit();
}

if (isset($_POST['submit_autor'])) {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $data_nascimento = $_POST['data_nascimento'];

    // Insere o autor na coleção 'autores'
    $result = $autoresCollection->insertOne([
        'nome' => $nome,
        'nacionalidade' => $nacionalidade,
        'data_nascimento' => $data_nascimento
    ]);

    // Verifica se o autor foi inserido corretamente
    if ($result->getInsertedCount() == 1) {
        echo "Autor cadastrado com sucesso!";
    }

    // Redireciona para a página de autores após o cadastro
    header('Location: autores.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Web - Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imagens/icone.png" type="image/png">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="livros.php">LIVROS</a></li>
                <li><a href="autores.php">AUTORES</a></li>
                <li><a href="cadastro.php">CADASTRO</a></li>
            </ul>
        </nav>
    </header>

    <main class="main">
        <div class="form-container">
            <h2>Cadastro de Livros</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" id="autor" name="autor" required>
                </div>
                <div class="form-group">
                    <label for="genero">Gênero</label>
                    <input type="text" id="genero" name="genero" required>
                </div>
                <div class="form-group">
                    <label for="ano_publicacao">Ano de Publicação:</label>
                    <input type="number" id="ano_publicacao" name="ano_publicacao" min="1000" max="9999" required>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" required>
                </div>
                <button type="submit" name="submit_livro">Cadastrar Livro</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Cadastro de Autores</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="nacionalidade">Nacionalidade</label>
                    <input type="text" id="nacionalidade" name="nacionalidade" required>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                <button type="submit" name="submit_autor">Cadastrar Autor</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Biblioteca Virtual. Todos os direitos reservados.</p>
    </footer>
</body>
</html>