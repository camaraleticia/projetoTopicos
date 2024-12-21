<?php
require 'mongo_connection.php';  // Conexão com o MongoDB

// Verifica se há um filtro de pesquisa
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

// Faz a consulta na coleção 'livros'
$query = [];
if ($filtro) {
    // Se houver um filtro, busca no título, autor ou gênero
    $query = [
        '$or' => [
            ['titulo' => new MongoDB\BSON\Regex($filtro, 'i')],
            ['autor' => new MongoDB\BSON\Regex($filtro, 'i')],
            ['genero' => new MongoDB\BSON\Regex($filtro, 'i')]
        ]
    ];
}

$livros = $livrosCollection->find($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Web - Livros</title>
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

    <main>
        <div class="table-container">
            <form class="filtro-container" method="GET" action="livros.php">
                <input type="text" id="filtro" name="filtro" placeholder="Pesquisar" value="<?php echo htmlspecialchars($filtro); ?>">
                <button type="submit" id="search-btn">
                    <img src="imagens/lupa.png" alt="Ícone de pesquisa">
                </button>
            </form>

            <table class="livros-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Gênero</th>
                        <th>Ano de Publicação</th>
                        <th>ISBN</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                            <td><?php echo htmlspecialchars($livro['genero']); ?></td>
                            <td><?php echo htmlspecialchars($livro['ano_publicacao']); ?></td>
                            <td><?php echo htmlspecialchars($livro['isbn']); ?></td>
                            <td><a href="editar_livro.php?id=<?php echo $livro['_id']; ?>"><img src="imagens/editar.png" alt="Editar"></a></td>
                            <td><a href="excluir_livro.php?id=<?php echo $livro['_id']; ?>"><img src="imagens/excluir.png" alt="Excluir"></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Biblioteca. Todos os direitos reservados.</p>
    </footer>
</body>
</html>