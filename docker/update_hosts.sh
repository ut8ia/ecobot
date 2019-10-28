#!/usr/bin/env bash

# find current ip`s of containers
NGINX_IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' ecobot_nginx)
DB_IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' ecobot_db)

# clear existing docker.local entry from /etc/hosts
$(sudo sed -i '/[[:space:]]ecobot\.local$/d' /etc/hosts)
$(sudo sed -i '/[[:space:]]ecodb\.local$/d' /etc/hosts)

$(sudo echo "$NGINX_IP   ecobot.local" >> /etc/hosts)
$(sudo echo "$DB_IP   ecodb.local" >> /etc/hosts)

echo "ecobot.local binded to $NGINX_IP "
echo "ecodb.local binded to $DB_IP "