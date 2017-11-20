####################################
# PHPDocker.io PHP 7.1 / FPM image #
####################################

FROM phpdockerio/php71-cli

# Install FPM
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
	wget \
	git \
	freetds-dev \
	build-essential \
	php7.1-opcache \
	php7.1-pdo \
	php7.1-xml \
	php7.1-fpm \
	php7.1-soap \
	php7.1-xmlrpc \
	php7.1-mbstring \
	php-pear \
	php7.1-dev \
	libcurl3-openssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  echo "extension=redis.so" > /etc/php/7.1/fpm/conf.d/20-redis.ini \
    &&  echo "extension=redis.so" > /etc/php/7.1/cli/conf.d/20-redis.ini

RUN wget -c "http://xdebug.org/files/xdebug-2.4.0.tgz" \
	&& tar -xf xdebug-2.4.0.tgz \
	&& cd xdebug-2.4.0 \
	&& phpize \
	&& ./configure \
	&& make && make install \
	&&  echo "zend_extension=xdebug.so" > /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
	&&  echo "zend_extension=xdebug.so" > /etc/php/7.1/cli/conf.d/20-xdebug.ini

# Configure FPM to run properly on docker
RUN sed -i "/listen = .*/c\listen = [::]:9000" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;access.log = .*/c\access.log = /proc/self/fd/2" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;clear_env = .*/c\clear_env = no" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;catch_workers_output = .*/c\catch_workers_output = yes" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pid = .*/c\;pid = /run/php/php7.1-fpm.pid" /etc/php/7.1/fpm/php-fpm.conf \
    && sed -i "/;daemonize = .*/c\daemonize = no" /etc/php/7.1/fpm/php-fpm.conf \
    && sed -i "/error_log = .*/c\error_log = /proc/self/fd/2" /etc/php/7.1/fpm/php-fpm.conf \
    && chmod 777 -R /srv
#    && usermod -u 1000 www-data

# The following runs FPM and removes all its extraneous log output on top of what your app outputs to stdout
CMD /usr/sbin/php-fpm7.1 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1

# Open up fcgi port
EXPOSE 9000
