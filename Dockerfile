FROM php:8.0-fpm
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libfreetype6-dev \
    libpng-dev\
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev  \
    zip \
    postgresql \
    postgresql-client \
    unzip \
    curl \
    libzip-dev 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set environment variables
ENV LIBZIP_CFLAGS -I/usr/include/libzip
ENV LIBZIP_LIBS -L/usr/lib/x86_64-linux-gnu -lzip

# Install extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-install zip

RUN chown -R www-data:www-data /var/www/html

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer