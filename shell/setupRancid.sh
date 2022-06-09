#!/bin/sh


#yum update
#yum install nano wget ftp telnet perl tcl expect gcc cvs rcs autoconf php-common php-gd php-pear
#yum install php-pecl-memcache php-xml mod_ssl MySQL-python
#groupadd netadm
#useradd -g netadm -c "Networking Backups" -d /home/rancid rancid
#mkdir /home/rancid/tar
#wget ftp://ftp.shrubbery.net/pub/rancid/rancid-3.13.tar.gz
#ar -zxvf rancid-3.13.tar.gz
#cd rancid-3.4.1
#./configure --prefix=/usr/local/rancid
#make install
#cp ./rancid-3.13/cloginrc.sample /home/rancid/.cloginrc
#chmod 0640 /home/rancid/.cloginrc
#chown -R rancid:netadm /home/rancid/.cloginrc
#chown -R rancid:netadm /usr/local/rancid/
#chmod 775 /usr/local/rancid/
#nano /usr/local/rancid/etc/rancid.conf
#su rancid
#/usr/local/rancid/bin/rancid-cvs
#exit
#cd /home/rancid/tar/
#wget https://viewvc.org/downloads/viewvc-1.1.24.tar.gz
#tar -zxvf viewvc-1.1.24.tar.gz
#cd viewvc-1.1.24
#./viewvc-install
#nano /usr/local/viewvc-1.1.24/viewvc.conf
#root_parents = /usr/local/rancid/var/CVS : cvs
#rcs_dir = /usr/local/bin
#use_rcsparse = 1
#cp /usr/local/viewvc-1.1.24/bin/cgi/*.cgi /var/www/cgi-bin
#chmod +x /var/www/cgi-bin/*.cgi
#chown apache:apache /var/www/cgi-bin/*.cgi
#nano /etc/httpd/conf/httpd.conf


# Custom Rancid Config
#cat << EOF >> /etc/httpd/conf/httpd.conf
#
## Custom Rancid Config
#<VirtualHost>
#        DocumentRoot /var/www
#        ScriptAlias /cgi-bin/ "/var/www/cgi-bin"
#        ScriptAlias /viewvc /var/www/cgi-bin/viewvc.cgi
#        ScriptAlias /query /var/www/cgi-bin/query.cgi
#<Directory "/var/www/cgi-bin">
#    AllowOverride None
#    Options None
#    Order allow,deny
#    Allow from all
#</Directory>
#</VirtualHost>
#EOF
#mysql -u root -p
#CREATE USER 'VIEWVC'@'localhost' IDENTIFIED BY ‘Password123’;
#GRANT ALL PRIVILEGES ON *.* TO 'VIEWVC'@'localhost' WITH GRANT OPTION;
#FLUSH PRIVILEGES;
#quit
#cd /usr/local/viewvc-1.1.24/bin
#./make-
#MySQL Hostname (leave blank for default):{Enter}
#
#MySQL Port (leave blank for default):{Enter}
#
#MySQL User: VIEWVC
#
#MySQL Password: Password123
#
#ViewVC Database Name [default: ViewVC]:{Enter}
#mysql -u root -p
#CREATE USER 'VIEWVCRO'@'localhost' IDENTIFIED BY ‘Password456’;
#GRANT SELECT ON ViewVC.* TO 'VIEWVCRO'@'localhost' WITH GRANT OPTION;
#FLUSH PRIVILEGES;
#quit
#nano /usr/local/viewvc-1.1.24/viewvc.conf
#enabled = 1
#host = localhost
#port = 3306
#database_name = ViewVC
#user = VIEWVC
#passwd = Password123
#readonly_user = VIEWVCRO
#readonly_passwd = Password456
