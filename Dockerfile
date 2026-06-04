# ============================================================
#  Dockerfile  →  menjalankan PHP + Apache di Railway
# ============================================================
FROM php:8.2-apache

# Ekstensi MySQLi (dipakai config/db.php) + mod_rewrite
RUN docker-php-ext-install mysqli && a2enmod rewrite

# Salin seluruh project ke web root Apache
COPY . /var/www/html/

# Pastikan folder uploads bisa ditulis (untuk upload foto)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/uploads

# Railway memberi nomor port lewat $PORT. Buat Apache mendengarkan port itu,
# lalu jalankan Apache di foreground.
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-80}/\" /etc/apache2/ports.conf && sed -i \"s/:80>/:${PORT:-80}>/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
