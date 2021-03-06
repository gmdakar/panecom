#!/bin/bash

#####
# ce script permet d'automatiser le déploiement du profil "panecom", de l'instance de dev "devpanecom" vers l'instance démo "panecomdistr". 
# Pour des raisons de simplicité un "lien symbolique" lie le profil "panecom" dans ces 2 instances.
# AVANT de lancer ce script, se positionner manuellement d'abord à la racine de l'instance de "devpanecom" (ex. cd htdocs/devpanecom/)
# sachant que l'instance de démo doit être au même niveau (exemple ici htdocs/panecomdistr/)
#####


# "find . -name index.php &&"  juste pour s'assurer d'être au bon endroit c'est à dire à la racine de l'instance de dev "devpanecom"
echo "find . -name index.php && git add . && git commit -m "new commmit" && git push"
find . -name index.php &&  git add . && git commit -m "new commit" && git push

echo "drush -y cex && git status"
drush -y cex && git status

echo "rm -r modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content"
rm -r modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content

echo "drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content && drush dcer file --folder=modules/custom/mydefaultcontent/content"
drush dcer taxonomy_term --folder=modules/custom/mydefaultcontent/content && drush dcer file --folder=modules/custom/mydefaultcontent/content

echo "drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content"
drush dcer media --folder=modules/custom/mydefaultcontent/content && drush dcer block_content --folder=modules/custom/mydefaultcontent/content

echo "rm -r profiles/panecom/config/install/* && cp -r  sites/default/files/config_CQioUJkW8Wj4yYrmfPRzkP3IXa4VmhbXhyNP9gEVQAxJRaPjoY9_pGDGhGXZS5j2F_oG499tYw/sync/*  profiles/panecom/config/install/ && cd profiles/panecom/config/install/ ; rm core.extension.yml; rm file.setting.yml; rm update.setting.yml ; cd ../../../../../devpanecom"
rm -r profiles/panecom/config/install/* && cp -r  sites/default/files/config_CQioUJkW8Wj4yYrmfPRzkP3IXa4VmhbXhyNP9gEVQAxJRaPjoY9_pGDGhGXZS5j2F_oG499tYw/sync/*  profiles/panecom/config/install/ && cd profiles/panecom/config/install/ ; rm core.extension.yml; rm file.setting.yml; rm update.setting.yml ; cd ../../../../../devpanecom

echo "cd profiles/panecom/config/install/ && find . -type f -exec sed -i -e '/^uuid: /d' {} \; && find . -type f -exec sed -i -e '/_core:/,+1d' {} \; ; cd ../../../../../devpanecom"
cd profiles/panecom/config/install/ && find . -type f -exec sed -i -e '/^uuid: /d' {} \; && find . -type f -exec sed -i -e '/_core:/,+1d' {} \; ; cd ../../../../../devpanecom

echo "rm -r profiles/panecom/modules/* && cp -r modules/* profiles/panecom/modules/ && rm -r profiles/panecom/themes/* && cp -r themes/* profiles/panecom/themes/"
rm -r profiles/panecom/modules/* && cp -r modules/* profiles/panecom/modules/ && rm -r profiles/panecom/themes/* && cp -r themes/* profiles/panecom/themes/

echo "cd ../../htdocs && rm -r panecomdistr/* && cp -r drupal-9.3.3/* panecomdistr/ && cd panecomdistr/profiles/ && ln -s ../../devpanecom/profiles/panecom/ panecom "
cd ../../htdocs && rm -r panecomdistr/* && cp -r drupal-9.3.3/* panecomdistr/ && cd panecomdistr/profiles/ && ln -s ../../devpanecom/profiles/panecom/ panecom 

echo "cd .. && cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ "
cd .. && cp sites/default/default.settings.php sites/default/settings.php && chmod -R 775 sites/default/ 

#because at the end of the day we will also provide all libraries needed in the package profiled (up to the end users to put it after in the root of if project)
echo "cp -r ../devpanecom/libraries/ profiles/panecom/"
cp -r ../devpanecom/libraries/ profiles/panecom/

echo "cp -r ../devpanecom/libraries/ ."
cp -r ../devpanecom/libraries/ .

echo "composer update --no-interaction"
composer update --no-interaction

echo "composer require drush/drush:8.x -W --no-interaction"
composer require drush/drush:8.x -W --no-interaction