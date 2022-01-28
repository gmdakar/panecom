QUE FAIRE POUR FAIRE MARCHER CE PROFILE
--------------------------------

- Placer le dossier dans votre nouvelle installation Drupal, dans le sous dossier [votreprojet]/profiles/

- Vous devez aussi disposer de l'outil de gestion de librairies dénommé "composer".

- En ligne de commande depuis la racine de votre projet,
  lancer les commandes suivantes: 
  composer require wikimedia/composer-merge-plugin
  composer config extra.merge-plugin.include.panecom_modules "profiles/panecom/modules/contrib/*/composer.json"
  composer config extra.merge-plugin.include.panecom_themes "profiles/panecom/themes/contrib/*/composer.json"
  composer install

- Vous pouvez maintenant installer le profil normalement avec la méthode classique en navigant 
  à partir de l'url du projet http://[votredomaineprojet]/ et IMPORTANT: Aprés chois du profil "Plateforme communautaire" choisissez l'anglais
  comme langue d'installation.
  
- Des données fictives de demo ont été incorporer dans le module "mydefaultcontent". Pour les voir affichés, installer le module
  correspondant dans le backend drupal depuis la liste de tous les modules ou via la commande en ligne "drush -y en mydefaultcontent" 