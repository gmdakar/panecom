#!/bin/bash

#####
#
# ****    NB: ce script doit etre placé à la racine de l'instance de dev "devpanecom"                ******** 
#
# Il permet d'installer le nouveau profil "panecom" déployé de l'instance de dev "devpanecom" vers l'instance démo "panecomdistr". 
# Pour des raisons de simplicité un "lien symbolique" lie le profil "panecom" dans ces 2 instances.
# AVANT de lancer ce script, se positionner manuellement d'abord à la racine de l'instance de "devpanecom" (ex. cd htdocs/devpanecom/)
# sachant que l'instance de démo doit être au même niveau (exemple ici htdocs/panecomdistr/)
# 
# Pour lancer le script en ligne de commandes: 
# 1) rendre executable le script. exemple: "chmod 775 installprofil.sh"
# 2) ./installprofil.sh 
#####

#en cas d'erreur on stoppe immédiatement le script
set -e

# "ls index.php &&"  juste pour s'assurer d'être au bon endroit c'est à dire à la racine de l'instance de dev "devpanecom"
echo "ls -al ../index.php"
ls -al index.php

echo "cd ../panecomdistr"
cd ../panecomdistr

echo "drush sql-drop --yes || true && drush -y site-install panecom --db-url=mysql://db-panecomdistr:99nTm8u4ZC@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com && drush -y en mydefaultcontent && drush cr"
drush sql-drop --yes || true && drush -y site-install panecom --db-url=mysql://db-panecomdistr:99nTm8u4ZC@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com && drush -y en mydefaultcontent && drush cr

echo "............................"
echo "***  PROFIL INSTALLED  *** "
echo "............................"

echo "cd ../devpanecom"
cd ../devpanecom
