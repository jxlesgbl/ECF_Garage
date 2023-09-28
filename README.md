# ECF_Garage

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre machine :

- PHP 7.4 ou supérieur
- Composer (https://getcomposer.org/)
- Symfony CLI (https://symfony.com/download)
- PostgreSQL (https://www.postgresql.org/) ou tout autre SGBDR de votre choix

## Installation

1. Clonez ce dépôt sur votre machine :
  
   git clone https://github.com/jxlesgbl/ECF_Garage.git

2. Accédez au répertoire du projet:

   cd ECF_Garage

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

# Pour accéder au back-office du site en tant qu'administrateur, suivez ces étapes :

Si les fixtures ne sont pas définies, veuillez dans le RegistrationController enlever le préfixe 'admin/' de la route 'admin/register' de la fonction register(), afin de pouvoir créer votre compte admin à l'url /register/.

Accédez ensuite à la page de connexion : http://localhost:8000/login

Connectez-vous avec les identifiants définis

Une fois connecté, vous aurez accès aux fonctionnalités d'administration.
