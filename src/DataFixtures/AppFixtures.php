<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Actor;
use App\Entity\Studio;
use App\Entity\User;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use joshtronic\LoremIpsum;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $lipsum = new LoremIpsum();

        $user = new User();
        $user->setName('user');
        $user->setEmail('user@user.com');
        $user->setPassword('simpleUser');
        $user->setRoles([ 0 => 'ROLE_USER']);
        $admin = new User();
        $admin->setName('admin');
        $admin->setEmail('admin@user.com');
        $admin->setPassword('adminUser');
        $admin->setRoles([ 0 => 'ROLE_USER', 1 => 'ROLE_ADMIN']);
        $manager->persist($user);
        $manager->persist($admin);

        $studios = [];
        $studioNames = ['Warner', 'Fox', 'Marvel', 'Disney'];
        foreach ($studioNames as $name) {
            $studio = new Studio();
            $studio->setName($name);
            $manager->persist($studio);
            $studios[] = $studio;
        }
        $genres = [];
        $genreNames = ['Science-fiction', 'Drama', 'Comedy', 'Fantasy', 'Aventure'];
        foreach ($genreNames as $name) {
            $genre = new Genre();
            $genre->setName($name);
            $manager->persist($genre);
            $genres[] = $genre;
        }
        $actors = [];
        for($i=0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setFirstName($faker->firstName());
            $actor->setLastName($faker->lastName());
            $actor->setImage('https://source.unsplash.com/250x250/?human');
            $manager->persist($actor);
            $actors[] = $actor;
        }
//        Movies
        for($i=0; $i < 15; $i++) {
            $movie = new Movie();
            $movie->setName($lipsum->words(rand(2, 6)));
            $movie->setOriginalName($lipsum->words(rand(2, 4)));
            $movie->setReleaseDate(new \DateTime());
            $movie->setImage('https://source.unsplash.com/250x250/?movie');
            $movie->setSynopsis($lipsum->paragraphs(rand(2, 4)));
            $movie->setSeen($faker->boolean);
            $movie->setWatchList($faker->boolean);
            $movie->setStudio($studios[$faker->numberBetween(0,count($studios)-1)]);
            $movie->addActor($actors[$faker->numberBetween(0,9)]);
            $movie->addGenre($genres[$faker->numberBetween(0,count($genres)-1)]);
            $manager->persist($movie);
        }
        $manager->flush();
    }
}
