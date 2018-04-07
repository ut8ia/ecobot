# download NOOBS Lite (Network install raspberian to device)
# https://www.raspberrypi.org/downloads/noobs/
# unpack files from NOOBS archive to SD card on your PC
# insert SD card in to raspberry pi, connect monitor, mouse, keyboard and start it
# Select raspberian OS from list - noobs will download and install it to SD card
# after installing and rebooting you log in to newly installed Raspberian OS
# default user:pi password:raspberry
# sudo passwd  # change default password, highly recomended
# sudo raspi-config # enable remote ssh , vnc


# copy and setup gpio bootstrap script
sudo cp ~/ecobot/setup/src/gpio_start.sh /etc/init.d/
update-rc.d gpio_start.sh defaults

# install required packages
sudo apt-get update
sudo apt-get install git nginx php7.0 php7.0-mysqli php7.0-fpm php7.0-mbstring php7.0-dom php7.0-gd php-curl mysql-server
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

# copy python scripts for DHT 22
cp ~/ecpbot/app/setup/humidity.py ~/Adafruit_Python_DHT/examples/
cp ~/ecpbot/app/setup/temp.py ~/Adafruit_Python_DHT/examples/


#SDS011 dust sensor
sudo apt-get install bc

# install php yii2 application
php -r "readfile('https://getcomposer.org/installer');" | php
sudo mv composer.phar /usr/local/bin/composer
cd ~/ekobot/app
composer install
