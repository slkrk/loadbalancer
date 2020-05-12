FROM php:7.4-cli-alpine

RUN apk add composer

ADD ./src /opt/app/src
ADD ./tests /opt/app/tests
ADD ./composer.json /opt/app/composer.json
WORKDIR /opt/app
RUN composer install \
    && chmod -R 777 /opt/app/vendor/phpunit

ENTRYPOINT ["/opt/app/vendor/bin/phpunit"]
CMD ["/opt/app/tests"]