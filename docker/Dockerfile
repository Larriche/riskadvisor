FROM ubuntu:22.04

LABEL maintainer="Insure App"

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /usr/share/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/usr/share/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php8.3-fpm php8.3-dev \
    php8.3-sqlite3 php8.3-gd php8.3-imagick \
    php8.3-curl \
    php8.3-imap php8.3-mysql php8.3-mbstring \
    php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap \
    php8.3-intl php8.3-readline \
    php8.3-ldap \
    php8.3-msgpack php8.3-igbinary php8.3-redis \
    php8.3-pcov \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get update \
    && apt-get install net-tools \
    && apt-get install -y mysql-client \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.3
RUN sed -i -e s/listen[[:space:]]=[[:space:]].\*/listen=9000/ /etc/php/8.3/fpm/pool.d/www.conf

COPY ./conf/php.ini /etc/php/8.3/cli/conf.d/99-insureapp.ini
COPY ./conf/php.ini /etc/php/8.3/fpm/conf.d/99-insureapp.ini
COPY ./conf/php-fpm.conf /etc/php/8.3/fpm/pool.d/logging.conf
COPY ./conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./helpers/start-app.sh /usr/local/bin/start-app.sh
RUN chmod +x /usr/local/bin/start-app.sh

RUN php-fpm8.3 -t

EXPOSE 9000

ENTRYPOINT ["start-app.sh"]
