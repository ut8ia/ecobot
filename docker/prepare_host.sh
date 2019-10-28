#!/usr/bin/env bash

sudo apt update

# if you want share /vendor folder for each container ( preferred way ) you must install all dependencies.
# this /vendor packeges manages by 'composer' - php based packet manager and you should install it
# for installation of 'composer' host machine needs :
sudo apt install curl php-cli php-mbstring git unzip

# go into home user dir
cd ~
# download 'composer installer'
curl -sS https://getcomposer.org/installer -o composer-setup.php
# install it as global command
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#docker
sudo apt install docker.io curl
#docker compose
sudo curl -L "https://github.com/docker/compose/releases/download/1.24.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

# set run docker daemon
sudo systemctl start docker
sudo systemctl enable docker

# possible acces right tio socket issues - add user to group
sudo usermod -aG docker $USER
# reboot neded here