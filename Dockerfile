FROM akkiio/laravel-web:7.4

WORKDIR /var/www/html

COPY ./ /var/www/html

RUN composer install
RUN cp .env.demo .env
RUN rm -rf database/database.sqlite
RUN touch database/database.sqlite
RUN php artisan migrate

RUN chmod -R 777 /var/www/html
