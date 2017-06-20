atelier_upload
==============
*A Symfony project created on June 20, 2017*


# Symfony 3.3

## Content:
1. Release controller_upload ==> Upload in controller
2. Release service_upload ==> Upload in service
3. Release upload_entity_1 ==> Upload from entity ==> create
4. Release upload_entity_2 ==> Upload from entity ==> create && edit

## Access
1. /article ==> CRUD for create article
2. /event ==> CRUD for create event

#### Pré-requis: 
composer ==> [Install Composer](https://getcomposer.org/doc/00-intro.md)

#### Initialisation du projet
1. **Avec ssh**: git clone git@github.com:florianpdf/atelier_upload_sf.git 
2. **Sans ssh**: git clone https://github.com/florianpdf/atelier_upload_sf.git
3. cd atelier_upload_sf
4. composer install
5. php bin/console doctrine:database:create
6. php bin/console doctrine:schema:update --force

#### How to get release:
https://stackoverflow.com/questions/35979642/how-to-checkout-remote-git-tag
