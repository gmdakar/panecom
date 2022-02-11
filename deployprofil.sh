#!/bin/bash

#####
# ce script permet d'automatiser le déploiement du profil "panecom", de l'instance de dev "devpanecom" vers l'instance démo "panecomdistr". 
# Pour des raisons de simplicité un "lien symbolique" lie le profil "panecom" dans ces 2 instances.
# AVANT de lancer ce script, se positionner manuellement d'abord à la racine de l'instance de "devpanecom" (ex. cd htdocs/devpanecom/)
# sachant que l'instance de démo doit être au même niveau (exemple ici htdocs/panecomdistr/)
#####




# "find . -name index.php &&"  juste pour s'assurer d'être au bon endroit c'est à dire à la racine de l'instance de dev "devpanecom"
echo "find . -name index.pp"
find . -name index.pp

echo "git add . && git commit -m "new commmit" && git push"
git add . && git commit -m "new commit" && git push

echo "drush -y cex && git status"
drush -y cex && git status

