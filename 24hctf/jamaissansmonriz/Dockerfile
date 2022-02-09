# syntax=docker/dockerfile:1.3-labs
FROM php:7.4.3-apache-buster
COPY files/html /var/www/html
COPY files/my_very_special_script.c /
COPY files/flag.txt /home/admin/flag.txt
ENV FLAG4 FLAG{4_good_job_devient_root_maintenant}
RUN << eot
useradd -ms /bin/bash admin
gcc /my_very_special_script.c -o /my_very_special_script.o
chmod +s /my_very_special_script.o
mkdir /var/www/uploads
chown www-data:www-data /var/www/uploads
# cleanup
apt-get update -y
apt-get install ncat -y
apt autoremove -y
apt clean all
find /var/cache -type f -delete
find /var/lib/apt/lists -type f -delete
find /var/log -type f -delete
eot
WORKDIR /var/www/html
EXPOSE 80