<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarkdownController extends AbstractController
{
    /**
     * @Route("/markdown-previewer", name="markdown-previewer")
     */
    public function markdownRender(): Response
    {
        return $this->render('markdown/markdown.html.twig');
    }

    /**
     * @Route("/markdown-render")
     */

    public function showTextFromTextareaInBlockBelow(Request $request, MarkdownParserInterface $parser): JsonResponse
    {
        $html = $request->request->get('md');
        $result = $parser->transformMarkdown($html);

        return $this->json(['html' => $result]);
    }
}
