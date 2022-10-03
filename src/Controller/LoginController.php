<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, HttpClientInterface $httpClient)
    {
        return $this->render('/login/index.html.twig');
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function login_check(Request $request, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('POST', 'https://reqres.in/api/login', [
            'body' => [
                'email' => $request->request->get('email'),
                'password'  => $request->request->get('password')
            ]
        ]);

        if($response->getStatusCode() == 200) {
            return $this->redirectToRoute('home');
        }
        else {
            return $this->redirectToRoute('login');
        }
    }
}