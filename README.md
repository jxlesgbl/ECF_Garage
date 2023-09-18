# ECF_Garage

# Projet Garage Web

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre machine :

- PHP 7.4 ou supérieur
- Composer (https://getcomposer.org/)
- Symfony CLI (https://symfony.com/download)
- PostgreSQL (https://www.postgresql.org/) ou tout autre SGBDR de votre choix

## Installation

1. Clonez ce dépôt sur votre machine :
  
   git clone https://github.com/votre-utilisateur/projet-garage-web.git

2. Accédez au répertoire du projet:

   cd projet-garage-web

3. Installez les dépendances PHP avec Composer :

   composer install

4. Copiez le fichier .env et configurez-le avec les informations de votre base de données PostgreSQL :

   cp .env.dist .env
   Éditez ensuite le fichier .env pour définir les paramètres de connexion à votre base de données.

5. Créez la base de données et exécutez les migrations :
   
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate

6. Démarrez le serveur de développement Symfony :
   
   symfony server:start


Accès au Back-Office (Administration)

Pour accéder au back-office du site en tant qu'administrateur, suivez ces étapes :

Se reporter au dossier pour explications.

Accédez à la page de connexion : http://localhost:8000/login

Connectez-vous avec les identifiants par défaut :

Nom d'utilisateur : admin
Mot de passe : admin
Une fois connecté, vous aurez accès aux fonctionnalités d'administration.
