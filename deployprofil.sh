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

echo "rm -rf profiles/panecom/config/sync || true && drush cr && drush -y cex && git status"
rm -rf profiles/panecom/config/sync || true && drush cr && drush -y cex && git status

echo "rm -rf modules/custom/mydefaultcontent/content"
rm -rf modules/custom/mydefaultcontent/content

echo "rm -rf sites/default/content"
rm -rf sites/default/content	

echo "git add . --force && git commit -m 'new commmit' && git push"
#git add . --force && git commit -m "new commit" && git push

echo "drush -y en mydefaultcontent || true"
drush -y en mydefaultcontent || true

#echo "drush -y en default_content_deploy || true"
#drush -y en default_content_deploy || true

echo "drush dcdes || true"
drush dcdes || true

echo "drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content"
drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content

echo "drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content && drush dcer file --folder=modules/custom/mydefaultcontent/content"
drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content && drush dcer file --folder=modules/custom/mydefaultcontent/content

echo "drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content"
drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content

echo "chmod -R 775 ../panecomdistr/ || true && cd ../../htdocs && rm -rf panecomdistr/* || true && cp -r devpanecom/* panecomdistr/ || true"
chmod -R 775 ../panecomdistr/ || true && cd ../../htdocs && rm -rf panecomdistr/* || true && cp -r devpanecom/* panecomdistr/ || true 

#echo "chmod -R 775 panecomdistr/modules/contrib && rm -rf panecomdistr/modules/contrib || true && rm -rf panecomdistr/modules/custom || true && rm -rf panecomdistr/themes/contrib || true && rm -rf panecomdistr/themes/custom"
#rm -rf panecomdistr/modules/contrib || true && rm -rf panecomdistr/modules/custom || true && rm -rf panecomdistr/themes/contrib || true && rm -rf panecomdistr/themes/custom

echo "mv panecomdistr/sites/default/files panecomdistr/sites/default/files_save"
mv panecomdistr/sites/default/files panecomdistr/sites/default/files_save

############### PHASE D'INSTALLATION DU PROFIL DEPLOYEE sur l'instance de démo "panecomdistr"  ###############################
echo "####"
echo "#### CAUTION : the module mydefaultcontent needs to be marked activated by default by all the ways ####"
echo "####"

echo "cd panecomdistr"
cd panecomdistr

echo "cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ || true"
cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ || true 

echo "rm sites/default/settings.local.php"
rm sites/default/settings.local.php

echo "$settings['config_sync_directory'] = 'profiles/panecom/config/sync'; >> sites/default/settings.php"
echo "\$settings['config_sync_directory'] = 'profiles/panecom/config/sync';" >> sites/default/settings.php 

echo "$settings['file_private_path'] = 'sites/default/private';"
echo "\$settings['file_private_path'] = 'sites/default/private';" >> sites/default/settings.php

#echo "global \$content_directories;" >> sites/default/settings.php
#echo "\$content_directories['sync'] = '/sites/default/content/sync';" >> sites/default/settings.php
#echo "\$settings['default_content_deploy_content_directory'] = 'sites/default/content';" >> sites/default/settings.php

echo "ls -al index.php"
ls -al index.php

echo "composer require drush/drush:10.x -W --no-interaction"
composer require drush/drush:10.x -W --no-interaction

echo "sed  's/standard/panecom/g' profiles/panecom/config/sync/core.extension.yml > delete.txt"
sed  's/standard/panecom/g' profiles/panecom/config/sync/core.extension.yml > delete.txt

echo "mv delete.txt profiles/panecom/config/sync/core.extension.yml"
mv delete.txt profiles/panecom/config/sync/core.extension.yml

#grep -q "mydefaultcontent" delete.txt; [ $? -eq 0 ] && echo "module mydefaultcontent is already activated" || sed '10 a\  mydefaultcontent: 0'  delete.txt > delete2.txt && mv delete2.txt profiles/panecom/config/sync/core.extension.yml
#echo "sed '10 a\  mydefaultcontent: 0' delete.txt > delete2.txt && mv delete2.txt profiles/panecom/config/sync/core.extension.yml"
#sed '10 a\  mydefaultcontent: 0' delete.txt > delete2.txt && mv delete2.txt profiles/panecom/config/sync/core.extension.yml

echo "rm delete.txt || true"
rm delete.txt || true

echo "drush sql-drop -y || true && drush -y site-install panecom --db-url=mysql://db-panecomdistr:xxxxxx@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com"
#drush sql-drop -y || true && drush -y site-install panecom --db-url=mysql://db-panecomdistr:99nTm8u4ZC@cloudpanel.digissol.pro:3306/db-panecomdistr --account-name=admin --account-pass=Passer@123 --site-name=PANECOM --site-mail=test@testpanecom.com

#car le module layout builder semble pas bien installer certaines configs layouts lors de la phase d'installation
#echo "drush -y cim"
#drush -y cim

echo "drush -y config-set system.performance css.preprocess TRUE"
#drush -y config-set system.performance css.preprocess TRUE

echo "drush -y config-set system.performance js.preprocess TRUE"
#drush -y config-set system.performance js.preprocess TRUE

#echo "drush cr"
#drush cr

echo "............................"
echo "***  PROFIL INSTALLED  *** "
echo "............................"

#retour à l'instance de dev
echo "cd ../devpanecom"
cd ../devpanecom