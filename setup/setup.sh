# download NOOBS Lite (Network install raspberian to device)
# https://www.raspberrypi.org/downloads/noobs/
# unpack files from NOOBS archive to SD card on your PC
# insert SD card in to raspberry pi, connect monitor, mouse, keyboard and start it
# Select raspberian OS from list - noobs will download and install it to SD card
# after installing and rebooting you log in to newly installed Raspberian OS
# default user:pi password:raspberry
# sudo passwd  # change default password, highly recomended
# sudo raspi-config # enable remote ssh , vnc
#
# clone this application
#
# cd ~
# git clone https://github.com/ut8ia/ecobot.git
#


# install required packages
sudo apt-get update
sudo apt-get install git nginx php7.0 php7.0-mysqli php7.0-fpm php7.0-mbstring php7.0-dom php7.0-gd php7.0-intl php-curl mysql-server bc
sudo mysql_secure_installation

# change auth plugin on maria db : $ sudo mysql -u root -p
# UPDATE mysql.user SET plugin = 'mysql_native_password', Password = PASSWORD('NEWPASSWORD') WHERE User = 'root';
# FLUSH PRIVILEGES;

# DHT 22 sensor issues
sudo apt-get install build-essential python-dev python-openssl
cd ~
git clone https://github.com/adafruit/Adafruit_Python_DHT.git
cd Adafruit_Python_DHT
sudo python setup.py install


# copy and setup gpio bootstrap script
sudo cp ~/ecobot/setup/src/gpio_start.sh /etc/init.d/
sudo update-rc.d gpio_start.sh defaults


# copy python scripts for DHT 22
cp ~/ecobot/setup/src/humidity.py ~/Adafruit_Python_DHT/examples/
cp ~/ecobot/setup/src/temp.py ~/Adafruit_Python_DHT/examples/


# install php yii2 application
php -r "readfile('https://getcomposer.org/installer');" | php
sudo mv composer.phar /usr/local/bin/composer
cd ~/ecobot/app
composer install

sudo cp ~/ecobot/setup/src/default /etc/nginx/sites-available/
systemctl restart nginx
