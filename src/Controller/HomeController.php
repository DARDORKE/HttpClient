<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, HttpClientInterface $httpClient): Response
    {

        $users1 = $httpClient->request('GET', 'https://reqres.in/api/users?page=1');
        $users2 = $httpClient->request('GET', 'https://reqres.in/api/users?page=2');

        $users = array_merge($users1->toArray()['data'], $users2->toArray()['data']);

        return $this->render('/home/index.html.twig', ['users' => $users]);
    }
}