# Coding Test

Segue aplicação desenvolvida para o coding-test. Ela possuí:

- Listagem, edição, criação e remoção e **Produtos** e **Fornecedores**.
- Relatório de estoque dos produtos
- Autenticação com usuário.
- Gerenciamente de usuário através de uma conta admin.
- Upload de imagens dos produtos.
- Testes automatizados das funcionalidades da aplicação.

## Pacotes utilizados

- [**Bootstrap**](https://getbootstrap.com): Utilizado para o front-end.
- [**Font Awnsome**](https://fontawesome.com): Utilizado para exibir os ícones.
- [**InputMask**](https://github.com/RobinHerbots/Inputmask): Utilizado para inputs formatados.

Além disto, foram utilizado alguns códigos prontos, obtidos em alguns fóruns. Cada um destes está documentado com o criador original e a fonte para o código. Estes foram:

- **JavaScript**: Função de substituíção de letras com acento para letras correspondentes sem acentos.
- **JavaScript**: Função que exibe na hora a imagem carregada pelo input.
- **JQuery**: Função que formata os inputs enquanto digita. Relacionado com o InputMask.

## Tecnologias Utilizadas

### PHP
Versão do PHP usada: `PHP 7.3.9 (cli)`

Habilitei algumas extensões no php.ini. Essas foram:

- `extension=fileinfo`: Utilizado para a validação das imagens passadas pelos inputs.
- `extension=gd2`: Utilizado para os testes automatizados com as imagens.
- Extensão do PDO, relacionada ao MySql.

### MySQL

MySQL utilizado: `5.7.20 - MySQL Community Server (GPL)`

## Instalação

1. Instalar as depências.

```
composer update
```

2. Configurar o arquivo .env. Um arquivo .env.example foi deixado na raiz do projeto.
    - Para a realização dos testes, configurar o arquivo .env.testing. Um arquivo .env.testing.example foi deixado na raiz do projeto.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead_teste
DB_USERNAME=homestead
DB_PASSWORD=secret
```

3. Criar tabela e dados no banco.

```
php artisan migrate:refresh --seed 
```

4. Gerar a chave da aplicação, caso necessário.

```
php artisan key:generate
```

5. Gerar o link da pasta storage com a public. Necessário para a exibição da imagens.

```
php artisan storage:link 
```

Após esses passos, a aplicação estará pronta para ser executada corretamente.

## Utilização

### Usuários

Para realizar a autenticação, foi criado o usuário padrão, com os seguintes dados:

- E-Mail: `joao@email.com`
- Senha: `senha`

Essa conta possuí os privilégios de admin, que lhe permite criar, redefinir e excluir outros usuários.

Além deste, também foram geradas algumas contas com o faker, todos com a seguinte senha:

- `senha`


### Fornecedores e Produtos

- **Listagem de itens:** Presente na seção correspondente para cada.
- **A criação de novos itens:** Presente na página de listagem. Deve estar logado para criar itens.
- **Exibição de dados:** Presente na página relacinada a cada item, tanto fornecedor quanto produto.
- **Alteração de dados e exclusão:** Presente na página relacionada a cada item.

Os Fornecedores e seus endereços foram criados utilizando o faker.

Os Produtos tiveram seus dados inseridos manualmente, no seu seeder.

As imagens também foram selecionadas manualmente e salvas em `/storage/app/img`. Durante o seed, elas são copiadas para a pasta `/storage/app/public/`, onde ficam as imagens enviadas pela aplicação. Esse processo exibe uma progressão no comando, duranto a cópia.

### Testes automatizados

Para executar os tests, pode ser usado o seguinte comando:

- `vendor\bin\phpunit`

## Lógica de negócio

A aplicação foi desenvolvida seguindo os requisitos solicitados. Ela foi nomeada como **General Goods**.

Ela possuí um relatório de produtos em estoque, com destaque para aqueles com 3 ou menos, indicando que está prestes a acabar. Essa indicação também está presente na listagem de produtos.

Ele possuí a listagem de fornecedores, produtos e suas informações, sendo a visualização livre para visitantes, como pessoas relacionadas à mercearia e precisam obter informações sobre produtos e estoque.

A edição, criação e remoção desses itens é feitas apenas para quem possuí usuário na aplicação, criado para as pessoas que administram esse inventário.

O gerenciamento desses usuários, como criação, exclusão e redefinição de usuários normais é feita por um usuário administrador, que também possuí todos os previlégios anteriores. Feito para os usuários que administram a mercearia.