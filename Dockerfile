#FROM php:8.2-cli
#
#RUN apt-get update -y && \
#    apt-get install -y libmcrypt-dev && \
#    apt-get install libonig-dev
#
#RUN curl -sS https://get.symfony.com/cli/installer | bash
#RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN docker-php-ext-install pdo mbstring
#RUN symfony server:ca:install
#
#WORKDIR /var/www
#COPY . /var/www
#
#RUN composer install
#
#EXPOSE 8000
#CMD php bin/console server:run 0.0.0.0:8000

FROM php:8.2-fpm-alpine

# Update
RUN apk --no-cache update && \
    apk --no-cache add bash git


# Install pdo
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# WORK DIR
COPY . /var/www
WORKDIR /var/www

RUN composer update
RUN composer install



# Start Symfony server on Port 8000
EXPOSE 8000
CMD ["/usr/local/bin/symfony", "local:server:start" , "--port=8000", "--no-tls"]