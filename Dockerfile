# ============================================================
#  Dockerfile  →  menjalankan PHP + Apache di Railway
# ============================================================
FROM php:8.2-apache

# ------------------------------------------------------------
# Paksa HANYA mpm_prefork (mod_php membutuhkannya).
# Memperbaiki "AH00534: apache2: Configuration error: More than one MPM loaded".
# Build akan GAGAL di sini kalau ternyata masih ada >1 MPM aktif,
# jadi error tidak akan lolos ke runtime.
# ------------------------------------------------------------
RUN set -eux; \
    a2dismod mpm_event mpm_worker 2>/dev/null || true; \
    rm -f /etc/apache2/mods-enabled/mpm_event.* \
          /etc/apache2/mods-enabled/mpm_worker.*; \
    a2enmod mpm_prefork rewrite; \
    mpm_count="$(ls /etc/apache2/mods-enabled/ | grep -c '^mpm_' || true)"; \
    echo "MPM enabled count = ${mpm_count}"; \
    test "${mpm_count}" = "1"

# Ekstensi MySQLi (dipakai config/db.php)
RUN docker-php-ext-install mysqli

# Hilangkan warning FQDN
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Salin seluruh project ke web root Apache
COPY . /var/www/html/

# Pastikan folder uploads bisa ditulis (untuk upload foto)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/uploads

# Railway memberi nomor port lewat $PORT. Buat Apache mendengarkan port itu,
# lalu jalankan Apache di foreground.
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-80}/\" /etc/apache2/ports.conf && sed -i \"s/:80>/:${PORT:-80}>/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
