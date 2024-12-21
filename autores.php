<?php
require 'mongo_connection.php';  // Conexão com o MongoDB

// Verifica se há um filtro de pesquisa
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

// Faz a consulta na coleção 'autores'
$query = [];
if ($filtro) {
    // Se houver um filtro, busca no nome, nacionalidade ou data de nascimento
    $query = [
        '$or' => [
            ['nome' => new MongoDB\BSON\Regex($filtro, 'i')],
            ['nacionalidade' => new MongoDB\BSON\Regex($filtro, 'i')],
            ['data_nascimento' => new MongoDB\BSON\Regex($filtro, 'i')]
        ]
    ];
}

$autores = $autoresCollection->find($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Web - Autores</title>
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
            <!-- Filtro de pesquisa -->
            <form class="filtro-container" method="GET" action="autores.php">
                <input type="text" id="filtro" name="filtro" placeholder="Pesquisar" value="<?php echo htmlspecialchars($filtro); ?>">
                <button type="submit" id="search-btn">
                    <img src="imagens/lupa.png" alt="Ícone de pesquisa">
                </button>
            </form>

            <table class="livros-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nacionalidade</th>
                        <th>Data de Nascimento</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autores as $autor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($autor['nome']); ?></td>
                            <td><?php echo htmlspecialchars($autor['nacionalidade']); ?></td>
                            <td><?php echo htmlspecialchars($autor['data_nascimento']); ?></td>
                            <td><a href="editar_autor.php?id=<?php echo $autor['_id']; ?>"><img src="imagens/editar.png" alt="Editar"></a></td>
                            <td><a href="excluir_autor.php?id=<?php echo $autor['_id']; ?>"><img src="imagens/excluir.png" alt="Excluir"></a></td>
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