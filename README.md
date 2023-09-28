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

4. Créez votre BDD puis configurez le fichier .env avec les informations de votre base de données PostgreSQL :
    
    a. Ouvrez une console ou un terminal où vous avez accès à PostgreSQL.
    
    b. Connectez-vous à PostgreSQL en utilisant un utilisateur qui a les privilèges nécessaires "ADMIN" pour créer des rôles et des bases de données. Par défaut, l'utilisateur "postgres" a ces privilèges. Vous pouvez vous connecter en utilisant la commande suivante (vous serez invité à saisir le mot de passe de l'utilisateur) :
    
       ```bash
       psql -U postgres *(ou votre user ADMIN)* -d template1
       ```
    
    c. Une fois connecté, vous pouvez créer un nouveau rôle (utilisateur) avec la commande CREATE ROLE. Par exemple, pour créer un rôle nommé "jules" avec un mot de passe, vous pouvez utiliser cette commande (remplacez "votre_mot_de_passe" par le mot de passe souhaité) :
    
       ```sql
       CREATE ROLE votre_utilisateur WITH LOGIN PASSWORD 'votre_mot_de_passe';
       ```
    
       Assurez-vous d'utiliser un mot de passe fort et sécurisé.
    
    d. Une fois que vous avez créé le rôle, avant de quitter la console PostgreSQL en utilisant la commande suivante :
   
      donnez les privilèges de création de db à votre utilisateur: ```ALTER USER votre_utilisateur CREATEDB;```
   Puis quittez :
       ```sql
       \q
       ```

     Éditez le fichier .env pour définir les paramètres de connexion à votre base de données.: DATABASE_URL="postgresql://user:password@127.0.0.1:5432/{nom_de_votre_BDD}?serverVersion=15&charset=utf8"

4. Créez/reliez la base de données et exécutez les migrations :
   
   php bin/console doctrine:database:create
   
   php bin/console doctrine:migrations:migrate

   Si vous avez des erreurs: 
    php bin/console doctrine:schema:update

6. Démarrez le serveur de développement Symfony :
   
   symfony server:start

# Il vous faudra aussi, afin de build le CSS, installer yarn (par npm ou homebrew si vous êtes sur MacOS) afin de lancer la commande : yarn encore dev --watch

# Pour accéder au back-office du site en tant qu'administrateur, suivez ces étapes :

Si les fixtures ne sont pas définies, veuillez dans le RegistrationController enlever le préfixe 'admin/' de la route 'admin/register' de la fonction register(), afin de pouvoir créer votre compte admin à l'url /register/.

Accédez ensuite à la page de connexion : http://localhost:8000/login

Connectez-vous avec les identifiants définis

Une fois connecté, vous aurez accès aux fonctionnalités d'administration.
