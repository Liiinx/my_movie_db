<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'movies')]
    public function getAllMovies(MovieRepository $movieRepository, GenreRepository $genreRepository, ActorRepository $actorRepository): Response
    {
        $movies = $movieRepository->findAll();
        $actors = $actorRepository->findAll();
        $genres = $genreRepository->findAll();
        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }
}
