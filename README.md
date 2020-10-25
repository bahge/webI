# Trabalho final de Programação Web I

## Requer a instalação do Docker e Docker-Compose

## Processo de instalação
- Linux
1. Clone o repositório
2. Libere o ambience.sh para preparar o ambiente, liberando a execução através do comando:
```chmod +x ambience.sh```
3. Execute o arquivo ```./ambience.sh```
4. Selecione a opção **1** para criar a build do docker;
5. Execute novamente o ```./ambience.sh```
6. Selecione a opção **3** para carregar os container's
7. Acesse http://localhost

## Parando o docker e a aplicação
1. Execute o arquivo ```./ambience.sh```
2. Acesse a opção **4** para interromper os container's do projeto

## Verificando o status da aplicação
1. Execute o arquivo ```./ambience.sh```
2. Acesse a opção **2** para acessar os status dos container's.
  
  
## Executando a aplicação
### Setando as variáveis de ambiente
O projeto foi concebido, buscando as variáveis de ambiente do arquivo ```.env``` encontrado na raiz da aplicação.  

#### Criando uma nova variável de ambiente
Use o padrão **CHAVE**=**valor**

Para isso execute:
1. Abra o arquivo ```.env```
2. Escreva a variável no padrão CHAVE=valor
3. Instancie a classe: ```config``` através por exemplo de um require_once: ```require_once("app/helpers/config.php");```
4. Carregue as variáveis de ambiente por exemplo dentro do bloco: 
```php
    try {
        config::getInstance()->loadFileEnv();
    } catch(Exception $e) {
       echo "Erro ao chamar a classe manipuladora das variáveis de ambiente do projeto: <br>" . $e->getMessage();
    }
```
