FROM php:8.1-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

#RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-png
#RUN docker-php-ext-install gd

#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
#RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy application folder
COPY . /var/www

# Copy existing permissions from folder to docker
#COPY --chown=www-data:www-data . /var/www
#RUN chown -R www-data:www-data /var/www 
RUN chown -R www-data:www-data .

# Set specific permissions for storage and bootstrap/cache directories

RUN chown -R www-data:www-data /var/www/storage
RUN chmod -R 755 /var/www/storage

RUN chown -R www-data:www-data /var/www/bootstrap/cache
RUN chmod -R 755 /var/www/bootstrap/cache
# change current user to www
USER www-data

EXPOSE 9000
CMD ["php-fpm"]
