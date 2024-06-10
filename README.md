Clone o projeto:
                
                git clone http://git.seduc.pa.gov.br/fab/pedemeia-back.git

Acesse a pasta do projeto:
                
                cd pedemeia-back

Copei o .env.example e altere o nome do arquivo para .env e altere as conexões para o seu acesso.

OBS: Para os próximos passos é necessário ter o Docker instalado.

Para iniciar o serviço docker e via terminal execute os seguintes comando:
                
    Para Buildar e levantar o serviço docker:
                
                docker compose up -d

    Acessar o container:
                
                docker-compose exec app bash

    Dentro do container execute:
                
                composer install


