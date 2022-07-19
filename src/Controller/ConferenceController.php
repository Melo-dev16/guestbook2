<?php

namespace App\Controller;

use App\Entity\Comment;
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
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/', name: 'Conferences')]
    public function index(): Response
    {
       
        return new Response($this->twig->render('conference/index.html.twig'));
    }

    #[Route('/conference/{slug}', name: 'SingleConference')]
    public function show(Request $request, Conference $conference, CommentRepository $comRepo): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $comRepo->findByCommentPaginator($conference, $offset);

        return new Response($this->twig->render('conference/show.html.twig',
            [
                'conference' => $conference,
                'comments' => $paginator,
                'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
                'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE)
            ]
        ));
    }
}
