FROM php:7.2-apache

ENV branch=master
ENV git=https://github.com/ThomasRumas/php-files-api.git

RUN apt update
RUN apt install git dos2unix -y
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN mkdir /files
RUN chmod u+x /files
WORKDIR /var/www/html

COPY entrypoint.sh /
RUN dos2unix /entrypoint.sh
RUN chmod u+x /entrypoint.sh

EXPOSE 80
VOLUME [ "/files" ]

ENTRYPOINT [ "sh","/entrypoint.sh" ]