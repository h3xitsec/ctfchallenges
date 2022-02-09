FROM tutum/lamp:latest
ENV DEBIAN_FRONTEND noninteractive
# Preparation
RUN \
  rm -fr /app/* && \
  apt-get update && apt-get install -yqq wget unzip php5-gd && \
  rm -rf /var/lib/apt/lists/* && \
  wget https://github.com/digininja/DVWA/archive/refs/tags/2.0.1.zip && \
  unzip /2.0.1.zip && \
  rm -rf app/* && \
  cp -r /DVWA-2.0.1/* /app && \
  rm -rf /DVWA-2.0.1 && \
  mv /app/config/config.inc.php.dist /app/config/config.inc.php && \
  sed -i "s/^\$_DVWA\[ 'db_user' \]     = 'dvwa'/\$_DVWA[ 'db_user' ] = 'admin'/g" /app/config/config.inc.php && \
  echo "sed -i \"s/p@ssw0rd/\$PASS/g\" /app/config/config.inc.php" >> /create_mysql_admin_user.sh && \
  echo 'session.save_path = "/tmp"' >> /etc/php5/apache2/php.ini && \
  sed -ri -e "s/^allow_url_include.*/allow_url_include = On/" /etc/php5/apache2/php.ini && \
  chmod a+w /app/hackable/uploads && \
  chmod a+w /app/external/phpids/0.6/lib/IDS/tmp/phpids_log.txt && \
  chmod 757 /app/config 
EXPOSE 80 3306
CMD ["/run.sh"]
