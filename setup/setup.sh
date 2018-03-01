# download NOOBS Lite (Network install raspberian to device)
# https://www.raspberrypi.org/downloads/noobs/
# unpack files from NOOBS archive to SD card on your PC
# insert SD card in to raspberry pi, connect monitor, mouse, keyboard and start it
# Select rapberian OS from list - noobs will download and install it to SD card
# after installing and rebooting you log in to newly installed Raspberian OS
# default user:pi password:raspberry
# sudo passwd  # change default password, highly recomended
# sudo raspi-config # enable remote ssh , vnc



sudo apt-get update
sudo apt-get install nginx
sudo apt-get install php7.0
sudo apt-get install php7.0-mysqli php7.0-fpm php7.0-mbstring php7.0-dom php7.0-gd php-curl
sudo apt-get install mysql-server
sudo mysql_secure_installation

# change auth plugin on maria db : $ sudo mysql -u root -p
# UPDATE mysql.user SET plugin = 'mysql_native_password', Password = PASSWORD('NEWPASSWORD') WHERE User = 'root';
# FLUSH PRIVILEGES;


# DHT 22 sensor
sudo apt-get install build-essential python-dev python-openssl
cd ~
git clone https://github.com/adafruit/Adafruit_Python_DHT.git
cd Adafruit_Python_DHT
sudo python setup.py install

#SDS011 dust sensor
sudo apt install bc

php -r "readfile('https://getcomposer.org/installer');" | php
sudo mv composer.phar /usr/local/bin/composer
cd ~/ekobot/app
composer install
