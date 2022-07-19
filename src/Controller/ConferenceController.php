<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'Conference')]
    public function index(Environment $twig, ConferenceRepository $repo): Response
    {
       
        return new Response($twig->render('conference/index.html.twig',
            [
                'conferences' => $repo->findAll()
            ]
        ));
    }

    #[Route('/conference/{id}', name: 'SingleConference')]
    public function show(Environment $twig, Conference $conference, CommentRepository $comRepo): Response
    {
       
        return new Response($twig->render('conference/show.html.twig',
            [
                'conference' => $conference,
                'comments' => $comRepo->findBy(['conference' => $conference],['createdAt' => 'DESC'])
            ]
        ));
    }
}
