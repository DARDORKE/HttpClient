<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostsController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function index(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        return $this->render('posts/index.html.twig', [
            'posts' => $response->toArray(),
        ]);
    }
}
