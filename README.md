# Trabalho Segundo bimestre

#### Alunos: 

Matheus Janoca Castelini -- RA: 250289 <br>
Pedro Henrique Gonçalvez de Souza -- RA: 250275

### Rodando o projeto

- Clone o repositório na sua maquina. <br>
git clone https://github.com/MatrCastelini23/aula-alfa-laravel.git

- Rode o comando para instalar as dependecias do Node <br>
npm install

- Rode o comando para instalar as dependecias do Composer <br>
composer install

- Copie o conteudo do .env.example e cole no .env, após gere a chave do artisan <br>
cp .env.example .env <br> php artisan key:generate

- Rode os dois serviços: <br>
npm run dev <br> php artisan serve

> Obs: um em cada terminal.

- Para finalizar rode as migrations em um terceiro terminal: <br>
php artisan migrate

> Obs: Como estaremos utilizando SQLite por enquanto, veja se ao rodar as migrations um aquivo aparece no caminho: <br> ./database/database.sqlite

- Acesse no navegador para conferir o projeto em produção <br>
localhost:8000/

#### Obsercação:

Caso queria utilizar as seeds criadas: 
- php artisan migrate:fresh (limpa o banco de dados SQLite)
- php artisan migrate:fresh --seed (limpa e roda as seeds)
- Para encontrar os dados fake vá ao arquivo database/seeders/DatabaseSeeder.php
