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


## Autoload de classes
Foi adicionado um autoload, para facilitar os carregamentos das classes.  
Atualmente apenas os diretórios ```app/helpers``` e ```app/installer``` estão inseridos no autoload.  


## Usando o PDOWrapper através da classe CRUD
Foi criado um PDOWrapper para auxiliar na manipulação do Banco de dados.  
Através da classe CRUD, menos verboso que o PDO tradicional ele já faz a preparação e a execução dos statments.  
O métodos disponíveis são: ```insert, read, update e delete```  
Acessa a pasta ```app/helpers/``` e visualize o arquivo ```crud.php```

## Sistema de Rotas
Para execução em url amigável, foi adicionado uma classe rotes, que carrega a variável ```$url```, enviando "CONTROLER/MÉTODO/PARAMETRO".  
Essa classe, executa a limpeza, sendo indicado apenas nomes em mínusculo, com hífem e sem acentos, além de verificar a existência do método na classe.
Por padrão, a classe ```home``` é enviada caso ocorra erro no carregamento, sendo passado o método ```index``` como método padrão para todas as controllers, para isso, a home e demais classes, devem implementar a interface **stdController**.

## Sistema de renderização de VIEW
As view são renderizadas através da classe helper **views**.  
Para instancia-la, basta usar o exemplo:  
```php
    $page = new views('CONTROLLER/METODO');
    $page->render();
```  
podendo ser passados **dados** na forma de array e outros arquivos de **header**, **menu** e **footer**  
```php
    $page = new views('CONTROLLER/METODO', ['name' => 'EXEMPLO'], ['header' => 'novoHeader']);
    $page->render();
```
Para que ocorra a renderização do novo arquivo, a extensão do arquivo deve ser php e **não** **deve** **ser** **declarada** **no** **array**.