# Trabalho Segundo bimestre

#### Alunos: 

Matheus Janoca Castelini -- RA: 250289 <br>
Pedro Henrique Gonçalvez de Souza -- RA: 250275

# Atividade prática: autenticação e área administrativa

## Como rodar

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
npm run dev          # em outro terminal
php artisan serve
```

## Contas de demonstração (somente ambiente local)

| Perfil (`profile.type`) | E-mail | Senha |
|---|---|---|
| admin | admin@example.com | password |
| user | gerados pelo Faker (veja em `/admin/users`) | password |

O administrador é criado apenas pelo seeder (`DatabaseSeeder`). Não existe formulário público que aceite `type = admin`: o cadastro (`UserController@create`) grava sempre o perfil `user`, definido no código e nunca lido da requisição.

## Como funciona

- **Autenticação:** sessão (`Auth::attempt` + `session()->regenerate()`).
- **Autorização:** o middleware `admin` (`AdminMiddleware`) protege todas as rotas `/admin/*`.
  - Visitante: redireciona para `/login`.
  - Autenticado sem perfil `admin`: 403.
  - Perfil `admin` (`User::isAdmin()`, via relação `User hasOne Profile`): segue.
- **Logout:** `POST /logout` com CSRF. Invalida a sessão, regenera o token e redireciona para `/login`. O botão fica em `resources/views/parts/header.blade.php`.
- **Cadastro público:** cria usuário comum e redireciona para o login com mensagem. Se um admin autenticado usar o formulário, volta para `/admin/users`.

## Limite de tentativas de login

Definido em `AppServiceProvider` (`RateLimiter::for('login', ...)`) e aplicado em `POST /login` com `throttle:login`.

- Limite: **5 tentativas por minuto** por combinação **e-mail + IP**.
- Na 6ª tentativa no mesmo minuto, a resposta é **429 Too Many Requests**, com o cabeçalho `Retry-After`.
- O contador fica no cache (`CACHE_STORE=database`).

## Cenários demonstrados (prints)

1. Visitante abrindo `/` e `/admin/users` (redireciona ao login): `prints/01-visitante.png`
2. Cadastro de conta comum: `prints/02-cadastro.png`
3. Login e logout da conta comum: `prints/03-login-logout.png`
4. Conta comum em `/admin/users` (403): `prints/04-403.png`
5. Admin entrando no painel: `prints/05-admin.png`

## Perguntas de reflexão

**Por que um usuário autenticado ainda pode receber 403?**
Porque autenticação responde "quem é você?" e autorização responde "o que você pode fazer?". O usuário logado sem perfil `admin` é identificado, mas não tem permissão para a área administrativa.

**Qual seria o risco de confiar apenas em um botão escondido na interface?**
Esconder o botão não impede a requisição. Qualquer pessoa pode digitar a URL ou enviar um POST manualmente (navegador, curl, Postman). A proteção real precisa estar no servidor, no middleware. Esconder o link é só conveniência de interface.

**Por que logout deve ser POST protegido por CSRF?**
Um logout por GET pode ser disparado por terceiros (uma imagem ou link em outro site) e deslogar o usuário sem que ele queira (CSRF). Com POST e token CSRF, só formulários gerados pela própria aplicação conseguem encerrar a sessão. Além disso, GET deve ser seguro e sem efeitos colaterais.

**Como o limite de tentativas de login ajuda e quais são suas limitações?**
Ajuda a dificultar força bruta e adivinhação de senhas. Limitações: quem usa muitos IPs contorna o limite; o bloqueio por e-mail permite que alguém trave de propósito a conta de outra pessoa; redes com IP compartilhado (NAT) podem punir usuários inocentes; e o limite sozinho não substitui senhas fortes nem autenticação em dois fatores.

**Como provisionar o primeiro administrador sem expor essa capacidade ao público?**
Por um canal controlado fora da aplicação pública: seeder de desenvolvimento, comando Artisan próprio ou inserção direta no banco por quem administra o ambiente. A senha vem de variável de ambiente ou é trocada após o primeiro acesso. O formulário público nunca aceita o tipo de perfil, e o campo não é preenchido a partir da requisição.
