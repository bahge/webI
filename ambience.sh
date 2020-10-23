#!/bin/bash

# Função do projeto
menu () {
	clear
	echo "=============================================================================="
	echo "| Gerenciador de projetos - v1.0                                             |"
	echo "|                                                                            |"
	echo "| MENU                                                                       |"
	echo "| 1. Build do Docker-compose                                                 |"
	echo "| 2. Verificar Status do Docker                                              |"
	echo "| 3. Carregar Container's do projeto                                         |"
    echo "| 4. Derrubar Container's do projeto                                         |"
	echo "| 9. Sair                                                                    |"
    echo "=============================================================================="	
	read -p "Digite uma opção: > " OPT
}

# Função criação da build do docker
makeDocker() {
	EXIST=$(./docker-compose.yaml)
	if [ $EXIST -eq 0 ]
	then
		echo "Executando a build do docker-compose"
		echo "--------------------------------------------------"
        docker-compose up -d
        echo "Build completa"
	else
		echo "O arquivo docker-compose não foi copiado, clone novamente o repositório"
	fi
}

# Função para verificação do status dos container's docker
verifyDocker() {
    docker stats
}

# Função para inicializar os container's do docker compose
startDocker() {
    MYSQL=""
    PHPMYADMIN=""
    APACHE=""
    MYSQL=`docker-compose ps | grep dockerapache_mysql-server_1 | grep Up`
    if [ "$MYSQL" != "" ]
    then
        S=1
        echo "O MYSQL está rodando, primeiro pare o Docker!"
    else
        S=0
        echo "O MYSQL está parado"
    fi
    PHPMYADMIN=`docker-compose ps | grep dockerapache_phpmyadmin_1 | grep Up`
    if [ "$PHPMYADMIN" != "" ]
    then
        S=$S+1
        echo "O PHPMyAdmin está rodando, primeiro pare o Docker!"
    else
        S=$S
        echo "O PHPMyAdmin está parado"
    fi
    APACHE=`docker-compose ps | grep dockerapache_web-server_1 | grep Up`
    if [ "$APACHE" != "" ]
    then
        S=$S+1
        echo "O APACHE está rodando, primeiro pare o Docker!"
    else
        S=$S
        echo "O APACHE está parado"
    fi
    pause 'Pressione [Enter] para continuar...'
    if [ "$S" == 0 ]
    then
        docker-compose start
    else
        echo "Pare primeiro os container's para start das operações"
        pause 'A opção para derrubar os containers ativos é a 4...'
    fi
}

function pause(){
   read -p "$*"
}

# Função para finalizar os container's do docker compose
stopDocker() {
    docker-compose stop
}



# Chama o menu
menu

if [ $OPT == "1" ]
then
	makeDocker
    menu
fi
if [ $OPT == "2" ]
then
	verifyDocker
    menu
fi
if [ $OPT == "3" ]
then
	startDocker
    menu
fi
if [ $OPT == "4" ]
then
	stopDocker
    menu
fi
if [ $OPT == "9" ]
then
	echo "Obrigado, encerrando aplicação"
	exit 0
else
	menu
	echo "Opção inválida"
fi