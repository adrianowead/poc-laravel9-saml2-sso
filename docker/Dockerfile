#=======================#
# composer já instalado #
#=======================#
FROM adrianowead/viware-base-php:1.1.0

# copiando configs do apache
COPY docker/apache/* /etc/apache2/sites-available/

RUN usermod -a -G sudo www-data

RUN chmod -R 775 /var/www/html

# ajustando permissão da pasta para o apache
# e habilitando alguns módulos
RUN chown -R www-data:www-data /var/www/html

RUN a2dissite 000-default.conf
RUN a2dissite default-ssl.conf

RUN a2ensite vhost-idp.conf
RUN a2ensite vhost-sp-a.conf
RUN a2ensite vhost-sp-b.conf
RUN a2ensite vhost-front-b.conf

# abrindo porta 80
EXPOSE 80

# iniciando supervisor
ENTRYPOINT ["supervisord"]
