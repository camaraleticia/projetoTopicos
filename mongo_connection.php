<?php
// Carregar o autoloader do Composer
require 'vendor/autoload.php'; // Certifique-se de que o caminho está correto

// Configuração de conexão com o MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017"); // URL do MongoDB

// Selecionar o banco de dados "biblioteca"
$database = $client->biblioteca;

// Definir as coleções
$autoresCollection = $database->autores; // Coleção de autores
$livrosCollection = $database->livros;   // Coleção de livros
?>