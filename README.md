![image](https://github.com/user-attachments/assets/bb5d5faa-6f11-4e73-950d-c057a6258b60)# projetoTopicos

# AUTORES 
Larissa Correa de Matos e Letícia Padilha Câmara

# DESCRIÇÃO
O projeto consiste em um sistema para gerenciar uma biblioteca, permitindo o cadastro, listagem, edição e remoção de livros e autores.

# ESTRUTURA DO PROJETO
biblioteca-web/
│
├── css/
│   └── style.css         # Arquivo de estilos para o projeto
│
├── imagens/              # Diretório para armazenar as imagens do projeto
│   ├── icone.png         # Ícone usado no favicon
│   ├── lupa.png          # Ícone de pesquisa
│   ├── editar.png        # Ícone para edição
│   └── excluir.png       # Ícone para exclusão
│
├── mongoDB/              # Diretório relacionado ao MongoDB
│
├── cadastro.php          # Página para cadastro de livros e autores
├── autores.php           # Página para exibição de autores
└── livros.php            # Página para exibição de livros

# IMAGEM DA CONSTRUÇÃO DO BANCO
![image](https://github.com/user-attachments/assets/80280490-0df5-4c78-bd23-c5ee93b694b1)



# INSTALAÇÃO DO COMPOSER 
composer install: Instala as dependências do projeto definidas no composer.json.
composer require mongodb/mongodb --ignore-platform-reqs: Adiciona a dependência mongodb/mongodb e ignora as verificações de compatibilidade de PHP e sistema.
composer require mongodb/mongodb: Adiciona a dependência mongodb/mongodb e verifica se o PHP e as extensões são compatíveis.

# VERSÃO DO PHP QUE FOI FEITA A INSTALAÇÃO
8.2.12

# VERSÃO DO php_mongodb.dll 
1.20
Foi colocado as extensões do mongo dentro do apache e colocado o aquivo php_mongodb.dll na pasta C:\xampp\php\ext

# CONCLUSÃO
O sistema de gerenciamento de livros facilitará a administração de uma biblioteca, proporcionando um acesso ágil e organizado aos dados de livros e autores, além de permitir que usuários realizem operações de forma simples e eficiente.
