# PHP Application Stage
FROM php:8.2.12-apache AS app

# Instalar dependencias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/
# Exponer el puerto 3000
EXPOSE 3000
# Configurar Apache para escuchar en el puerto 3000
RUN sed -i 's/80/3000/' /etc/apache2/ports.conf
# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Configurar el entorno de trabajo
WORKDIR /var/www/html

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
