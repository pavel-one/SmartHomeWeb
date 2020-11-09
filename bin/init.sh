#!/bin/bash
RED='\033[0;31m'         #  ${RED}
GREEN='\033[0;32m'      #  ${GREEN}
YELLOW='\033[33m'      #  ${YELLOW}
BLUE='\033[36m'      #  ${BLUE}
NORMAL='\033[0m'      #  ${NORMAL}

GREEN_BG='\e[42m\e[37m'      #  ${GREEN}
RED_BG='\e[41m\e[37m'      #  ${GREEN}
BLUE_BG='\e[46m\e[37m'      #  ${GREEN}

BUILD="[${YELLOW}BUILD${NORMAL}] "
INFO="${GREEN_BG}[INFO]${NORMAL} "
ALERT="${RED_BG}[ALERT]${NORMAL} "
INPUT="${BLUE_BG}[INPUT]${NORMAL} "

HR="----------------------------------------------"
ID=$(id -u)
GID=$(id -g)
ENV_DIR="${PWD}/bin/env/"

echo -e "${INFO} Привет, ${USER}! Сейчас начнем инициализацию проекта, продолжить? [y/n]";
rm .env;
echo -en "${INPUT}";
read continue;

if [[ ${continue} != "y" ]]; then
	exit 1;
fi

echo -en "${INPUT} Название приложения: ";
read APP_NAME;
echo -e "APP_NAME=\"${APP_NAME}\"" >> .env
echo -e "APP_KEY=" >> .env

echo -en "${INPUT} Локальный или прод? [l/p]: ";
read ENV_INPUT;

echo -e "DOCKER_USER=${USER}" >> .env
echo -e "DOCKER_UID=${ID}" >> .env
if [[ "${ENV_INPUT}" == "p" ]]; then
	echo -e "APP_ENV=production" >> .env
	echo -e "APP_DEBUG=false" >> .env
else
	echo -e "APP_ENV=local" >> .env
	echo -e "APP_DEBUG=true" >> .env
fi

echo -en "${INPUT} Адрес сайта без http's: ";
read APP_BASE_URL;
echo -e "APP_BASE_URL=${APP_BASE_URL}" >> .env

echo -e "\n" >> .env;
echo -e "DB_CONNECTION=mysql" >> .env
echo -e "DB_HOST=db" >> .env
echo -e "DB_PORT=3306" >> .env

echo -en "${INPUT} Название бд: ";
read DB_DATABASE;
echo -e "DB_DATABASE=${DB_DATABASE}" >> .env

echo -en "${INPUT} Пользователь бд: ";
read DB_USERNAME;
echo -e "DB_USERNAME=${DB_USERNAME}" >> .env

echo -en "${INPUT} Пароль бд: ";
read DB_PASSWORD;
echo -e "DB_PASSWORD=${DB_PASSWORD}" >> .env

# Все по умолчанию
for file in `find ${ENV_DIR} -type f -name "*.default.env"`
do
    echo -e "\n # ${file} included \n" >> .env;
    cat ${file} >> .env;
done


if [[ "${ENV_INPUT}" != "p" ]]; then
	for file in `find ${ENV_DIR} -type f -name "*.prod.env"`
	do
        echo -e "\n # ${file} included \n" >> .env;
        cat ${file} >> .env;
	done
else
	for file in `find ${ENV_DIR} -type f -name "*.local.env"`
	do
        echo -e "\n # ${file} included \n" >> .env;
        cat ${file} >> .env;
	done
fi

for file in `find ${ENV_DIR} -type f -name "*.local.env"`
do
    echo -e "\n # ${file} included \n" >> .env;
    cat ${file} >> .env;
done

echo -e "${INFO} .env файл сгенерирован!";
cat .env;
echo -e "\n";

