#!/bin/sh
#\cp -fR -a /srv/eyesofnetwork/eonweb.dev/. /srv/eyesofnetwork/eonweb
#chmod -R 777 /srv/eyesofnetwork/eonweb

#### dos2unix ./UpdateVersion.sh 

cp -fR -a /srv/eyesofnetwork/eonweb.dev/module/incident/. /srv/eyesofnetwork/eonweb/module/incident
cp -fR -a /srv/eyesofnetwork/eonweb.dev/include/. /srv/eyesofnetwork/eonweb/include
cp -fR -a /srv/eyesofnetwork/eonweb.dev/ansible/. /srv/eyesofnetwork/eonweb/ansible
cp -fR -a /srv/eyesofnetwork/eonweb.dev/footer.php /srv/eyesofnetwork/eonweb/footer.php
cp -fR -a /srv/eyesofnetwork/eonweb.dev/header.php /srv/eyesofnetwork/eonweb/header.php
chmod -R 777 /srv/eyesofnetwork/eonweb/footer.php
chmod -R 777 /srv/eyesofnetwork/eonweb/header.php
chmod -R 777 /srv/eyesofnetwork/eonweb/module/incident
chmod -R 777 /srv/eyesofnetwork/eonweb/include


echo 'Update completed'