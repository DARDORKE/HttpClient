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
        $response = $httpClient->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            "body" => [
                "title" => "Test Post",
                "body" => "Contenu du post",
                "userId" => 2,
            ]
        ]);
        return $this->render('posts/index.html.twig', [
            'post' => $response->toArray(),
        ]);
    }
}
