<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarkdownController extends AbstractController
{
    /**
     * @Route("/markdown-previewer", name="markdown-previewer")
     */
    public function index(): Response
    {
        return $this->render('markdown/markdown.html.twig');
    }
}
