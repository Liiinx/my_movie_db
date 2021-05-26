<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\User;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/{userId}/movies/genre/{genreId}', name: 'userMoviesByGenre')]
    public function index(User $userId, Genre $genreId, MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findByUserGenre($userId, $genreId);
        return $this->render('user/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
