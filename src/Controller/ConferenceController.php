<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'Conference')]
    public function index(Request $request): Response
    {
        $greet = '';

        if($name = $request->query->get('hello')){
            $greet = sprintf('Hello %s', htmlspecialchars($name));
        }
        return $this->render('conference/index.html.twig', [
            'greet' => $greet
        ]);
    }
}
