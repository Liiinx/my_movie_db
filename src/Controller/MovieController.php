<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Studio;
use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\StudioRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function getAllMovies(MovieRepository $movieRepository,
                                 GenreRepository $genreRepository,
                                 ActorRepository $actorRepository,
                                 StudioRepository $studioRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();
            $movies = $user->getMovies();
//            foreach ($movies as $movie) {
//                $actors[] = $movie->getActors();
//                $genres[] = $movie->getGenres();
//                $studios[] = $movie->getStudio();
//            }
            return $this->render('movie/index.html.twig', [
                'movies' => $movies,
                'user' => $user,
            ]);
        } else {
            $movies = $movieRepository->findAll();
            $actors = $actorRepository->findAll();
            $genres = $genreRepository->findAll();
            $studios = $studioRepository->findAll();
            return $this->render('movie/index.html.twig', [
                'movies' => $movies,
                'genres' => $genres,
                'studios' => $studios,
                'actors' => $actors
            ]);
        }
    }

    #[Route('/genre/{id}', name: 'moviesByGenre')]
    public function getMoviesByGenre(Genre $genre): Response
    {
        if (!$genre)
            return $this->redirectToRoute('movies');
        return $this->render('movie/index.html.twig', [
            'movies' => $genre->getMovies(),
            'genre' => $genre
        ]);
    }
    #[Route('/actor/{id}', name: 'moviesByActor')]
    public function getMoviesByActor(Actor $actor): Response
    {
        if (!$actor)
            return $this->redirectToRoute('movies');
        return $this->render('movie/index.html.twig', [
            'movies' => $actor->getMovies(),
            'actor' => $actor
        ]);
    }
    #[Route('/studio/{id}', name: 'moviesByStudio')]
    public function getMoviesByStudio(Studio $studio): Response
    {
        if (!$studio)
            return $this->redirectToRoute('movies');
        return $this->render('movie/index.html.twig', [
            'movies' => $studio->getMovies(),
            'studio' => $studio
        ]);
    }

}
