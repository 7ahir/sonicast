# Dockerfile for Sonicast FrontEnd
# Install image from official PHP docker image that has Apache server
FROM php:8.0-apache

# Expose image on port 80
EXPOSE 80

# Position in the Apache Web Directory 
WORKDIR /var/www/html/

# Copy current content in the Apache Web Directory
COPY . .