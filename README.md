# MoneyGuard-poo2

Aplicacao PHP para controle de despesas compartilhadas, grupos e acertos de
pagamento.

## Executar com Docker

O `docker-compose.yml` cria dois containers:

- `moneyguard-app`: aplicacao PHP/Apache.
- `moneyguard-db`: banco PostgreSQL com o schema de `sql/BD_money_guard.sql`.

Para construir a imagem e subir os containers:

```bash
docker compose up --build
```

Acesse:

```text
http://localhost:8080
```

A imagem da aplicacao sera criada com o nome:

```text
moneyguard-poo2-app:latest
```

Comandos uteis:

```bash
docker compose ps
docker compose down
docker compose down -v
```

Use `docker compose down -v` apenas quando quiser apagar tambem os dados do
banco local.

## Contrato de API

O contrato de API esta em:

```text
docs/openapi.yaml
```

Ele descreve as rotas HTTP do sistema, os formularios esperados, as respostas
HTML/redirecionamentos e as rotas JSON usadas pelo front-end.

## Executar sem Docker

Crie o `.env` com base no `.env.example`:

```bash
cp .env.example .env
```

Instale as dependencias:

```bash
composer install
```

Configure um banco PostgreSQL e execute o script:

```text
sql/BD_money_guard.sql
```
