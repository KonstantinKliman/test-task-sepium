
FROM php:8.3-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY Public/ /var/www/html/Public/
COPY App/ /var/www/html/App/

RUN ln -s /var/www/html/Public/index.php /var/www/html/index.php

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

RUN a2enmod rewrite

COPY Public/.htaccess /var/www/html/Public/.htaccess

RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/Public\n\
    <Directory /var/www/html/Public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
