# my_movie_db

* clone the repository
* inside the project directory, run `composer install`
* copy the .env file and name .env.local
* put your database connexion in .env.local file
https://symfony.com/doc/current/doctrine.html
* run `symfony console doctrine:database:create` to create your database
* run `symfony console doctrine:fixtures:load` to create data inside
* run `symfony server:start`
* go to localhost in web navigator

