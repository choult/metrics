# Adapted from https://github.com/maxpou/docker-symfony/blob/master/php7-fpm/Dockerfile
# and https://hub.docker.com/r/khanhicetea/php7-fpm-docker/~/dockerfile/
FROM ubuntu:xenial

RUN LC_ALL=en_US.UTF-8 apt-get clean && apt-get -y update && apt-get install -y locales curl software-properties-common git \
  && locale-gen en_US.UTF-8
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y --fix-missing --force-yes php7.0-bcmath php7.0-bz2 php7.0-cli php7.0-common php7.0-curl \
                php7.0-cgi php7.0-dev php7.0-fpm php7.0-gd php7.0-gmp php7.0-imap php7.0-intl \
                php7.0-json php7.0-ldap php7.0-mbstring php7.0-mcrypt php7.0-mysql \
                php7.0-odbc php7.0-opcache php7.0-phpdbg php7.0-pspell \
                php7.0-readline php7.0-recode php7.0-soap php7.0-sqlite3 \
                php7.0-tidy php7.0-xml php7.0-xmlrpc php7.0-xsl php7.0-zip \
                php7.0-memcached php7.0-xdebug
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php/7.0/cli/php.ini
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/upload_max_filesize = .*/upload_max_filesize = 10M/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/post_max_size = .*/post_max_size = 12M/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini
RUN echo "\nextension=memcached.so" >> /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/pid =.*/pid = \/var\/run\/php7.1-fpm.pid/" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i -e "s/error_log =.*/error_log = \/proc\/self\/fd\/2/" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i "s/listen = .*/listen = 9000/" /etc/php/7.0/fpm/pool.d/www.conf
RUN sed -i "s/;catch_workers_output = .*/catch_workers_output = yes/" /etc/php/7.0/fpm/pool.d/www.conf
RUN curl https://getcomposer.org/installer > composer-setup.php && php composer-setup.php && mv composer.phar /usr/local/bin/composer && rm composer-setup.php
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#EXPOSE 9000
#CMD ["php-fpm7.0"]

ARG TIMEZONE

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip

#RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias console="php bin/console"' >> ~/.bashrc

WORKDIR /var/www/app

EXPOSE 9000
CMD ["php-fpm7.0"]
