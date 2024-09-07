# Projeto Parquimica - API

Para a instalação do projeto utilize recomenda-se que utilize docker, caso utilize o sistema operacional Windows, utilize o WSL.

## Instalação do projeto localmente:
Clone o projeto
```sh
git clone https://github.com/renananchieta/parquimica-api.git
```
```sh
cd parquimica-api/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Remova a pasta .git
```sh
sudo rm -r .git
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acesse o container
```sh
docker-compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```
## Possíveis erros:
Caso ocorra um erro na instalação, remova o arquivo package.json que está na raíz do projeto e tente executar o comando anterior novamente.

# Publicar o projeto no servidor SSH:
Acessar o servidor com suas credenciais 
```sh
ssh -p 222 <usuario>@site.parquimica.com.br
<senha>
```

Acesse a pasta da API do projeto
```sh
cd parquimica-api
```

Após realizar as alterações necessárias no ambiente local e publicar na branch principal, atualize o projeto no servidor SSH
```sh
git pull origin main
```

## Reiniciar o serviço Docker
Caso seja necessário parar os serviços docker, acesse a pasta raíz do projeto parquimica-api e execute
```sh
docker compose down
```

Iniciar os serviços docker
```sh
docker compose up -d
```
ou
```sh
docker compose up -d --build
```

O servidor SSH não tem o Docker Compose instalado e para acessar o container para executar os comandos php
```sh
docker exec -it Skeleton-app bash
```

# Acessar o serviço
Para verificar se os serviços estão funcionando corretamente acesse

Local:
```sh
localhost:8000
```

Produção
```sh
https://srcs.parquimica.com.br/
```

