#!/usr/bin/env bash

# add the PHP7 repositories
echo "Adding PHP7 repositories..."
add-apt-repository -y ppa:ondrej/php

# update the system, install php7
echo "Updating the box's system..."
apt-get update
apt-get upgrade -y
apt-get auto-remove -y
apt-get install -y php7.0 \
                   php7.0-fpm \
                   php7.0-cli \
                   php7.0-xml

# add composer
echo "Downloading Composer..."
curl -sS http://getcomposer.org/installer | php --

echo "Moving composer to a PATH directory..."
chmod a+x composer.phar
mv composer.phar /usr/local/bin/composer
