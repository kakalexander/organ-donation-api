# Usar a imagem oficial do PHP com FPM
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    libxml2-dev \
    libicu-dev \
    libonig-dev \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring xml

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar o diretório de trabalho
WORKDIR /var/www

# Copiar o código do projeto para o diretório de trabalho no container
COPY . .

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

# Configurar permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expor a porta 9000
EXPOSE 9000

# Iniciar o servidor PHP-FPM
CMD ["php-fpm"]
