# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Establece el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Habilita el uso de archivos .htaccess
RUN a2enmod rewrite

# Asigna permisos al directorio de trabajo (opcional)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80 para servir la aplicación
EXPOSE 80

# Comando por defecto para ejecutar Apache
CMD ["apache2-foreground"]
