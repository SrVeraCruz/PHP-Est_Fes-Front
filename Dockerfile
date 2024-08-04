# Usar imagem PHP com Apache
FROM php:8.1-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar mod_rewrite
RUN a2enmod rewrite

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Configurar ServerName para evitar o aviso
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expor a porta 80
EXPOSE 80

# Iniciar o Apache
CMD ["apache2-foreground"]
