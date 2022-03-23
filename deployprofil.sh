#!/bin/bash

#####
#
# ****    NB: ce script doit etre placé à la racine de l'instance de dev "devpanecom"                ******** 
#
# Il permet d'automatiser le déploiement du profil "panecom", de l'instance de dev "devpanecom" vers l'instance démo "panecomdistr". 
# Pour des raisons de simplicité un "lien symbolique" lie le profil "panecom" dans ces 2 instances.
# AVANT de lancer ce script, se positionner manuellement d'abord à la racine de l'instance de "devpanecom" (ex. cd htdocs/devpanecom/)
# sachant que l'instance de démo doit être au même niveau (exemple ici htdocs/panecomdistr/)
# 
# Pour lancer le script en ligne de commandes: 
# 1) rendre executable le script. exemple: "chmod 775 deployprofil.sh"
# 2) ./deployprofil.sh 
#####

#en cas d'erreur on stoppe immédiatement le script
set -e

# "ls index.php &&"  juste pour s'assurer d'être au bon endroit c'est à dire à la racine de l'instance de dev "devpanecom"
echo "ls -al index.php"
ls -al index.php

echo "rm -rf sites/default/files/config_* || true && drush cr && drush -y cex && git status"
rm -rf sites/default/files/config_* || true && drush cr && drush -y cex && git status

echo "git add . --force && git commit -m 'new commmit' && git push"
git add . --force && git commit -m "new commit" && git push

echo "rm -rf modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content"
rm -rf modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content

echo "drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content"
drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content

echo "drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content"
drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content

echo "chmod -R 775 ../panecomdistr/ || true && cd ../../htdocs && rm -rf panecomdistr/* || true && cp -r devpanecom/* panecomdistr/ || true"
chmod -R 775 ../panecomdistr/ || true && cd ../../htdocs && rm -rf panecomdistr/* || true && cp -r devpanecom/* panecomdistr/ || true 


############### PHASE D'INSTALLATION DU PROFIL DEPLOYEE sur l'instance de démo "panecomdistr"  ###############################
echo "cd panecomdistr"
cd panecomdistr

echo "cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ || true"
cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ || true 

echo "ls -al index.php"
ls -al index.php

echo "composer require drush/drush:10.x -W --no-interaction"
composer require drush/drush:10.x -W --no-interaction

echo " perl -pi.bak -e 's/standard/panecom/g' sites/*/*/*/*/core.extension.yml"
perl -pi.bak -e 's/standard/panecom/g' sites/*/*/*/*/core.extension.yml
 
echo "drush sql-drop --yes || true && drush -y site-install --existing-config --db-url=mysql://db-panecomdistr:99nTm8u4ZC@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com && drush -y en mydefaultcontent && drush cr"
drush sql-drop --yes || true && drush -y site-install --existing-config --db-url=mysql://db-panecomdistr:99nTm8u4ZC@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com && drush -y en mydefaultcontent && drush cr

echo "drush -y config-set system.performance css.preprocess TRUE"
drush -y config-set system.performance css.preprocess TRUE

echo "drush -y config-set system.performance js.preprocess TRUE"
drush -y config-set system.performance js.preprocess TRUE

#car le module layout builder semble pas bien installer certaines configs layouts lors de la phase d'installation
echo "drush -y cim"
drush  -y cim

#les contenus existants 
echo "drush -y en mydefaultcontent"
drush -y en mydefaultcontent

echo "............................"
echo "***  PROFIL INSTALLED  *** "
echo "............................"

#retour à l'instance de dev
echo "cd ../devpanecom"
cd ../devpanecom