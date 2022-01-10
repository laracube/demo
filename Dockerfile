FROM akkica/laravel-web:8.1

WORKDIR /var/www/html

COPY ./ /var/www/html

RUN composer install
RUN cp .env.demo .env
RUN rm -rf database/database.sqlite
RUN touch database/database.sqlite
RUN php artisan migrate
RUN php artisan db:seed

RUN chmod -R 777 /var/www/html
