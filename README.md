Projet Géoloc

Lancer le script bdd.sql qui est dans le dossier script. Lancer les 4 autres scripts situé dans le meme dossier.

Pour se connecter, il faut utuliser ;
username = admin
password = admin

voici les fichiers dans le dossier .gitignore : 
upload/upload_images
.idea
.env
.env.dist
vendor
config

Dans le .env, il y a les informations à bdd. 
Dans le .env.dist, il y a DB_HOST, DB_NAME, DB_USERS, DB_PASS
Dans le fichier config, il y a le chemin pour l'upload d'image

Il y a une librairie qui est faker pour les scripts.