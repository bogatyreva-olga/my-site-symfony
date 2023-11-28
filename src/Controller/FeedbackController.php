<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\FeedbackMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback/messages", methods={"GET"})
     */
    public function getMessages(Request $request): JsonResponse
    {
        $categoryId = (int)$request->query->get("categoryId");
        /*здесь будет код, к-ый будет отфильтровывать массив сообщений по категории, вернуть*/

        return $this->json(["feedbackMessages" => []]);
    }

    /**
     * @Route("/feedback/messages", methods={"POST"})
     */
    public function saveMessages(Request $request, Filesystem $filesystem): JsonResponse
    {
        $userName = $request->request->get('userName');
        $message = $request->request->get('message');
        $categoryId = $request->request->get('categoryId');
        $fbm = new FeedbackMessage($userName, $message, $categoryId);
        $messages = [];
        if ($filesystem->exists('/tmp/fbm.txt')) {
            $fileContent = file_get_contents('/tmp/fbm.txt');
            if ($fileContent !== false && $fileContent !== ''){
                $messages = json_decode($fileContent);
            }
        }
        $messages[] = $fbm;
        $fbmsJson = json_encode($messages);
        $filesystem->dumpFile("/tmp/fbm.txt", $fbmsJson);
        dump($fbmsJson);

        return $this->json($fbm);
    }

    /**
     * @Route("/feedback-message")
     */
    public function index(): Response
    {
        return $this->render('feedback-message/feedback-message.html.twig', [
            'feedbackMessages' => $this->getFeedbackMessagesByCategoryId(),
            'categories' => $this->getFeedbackCategories(),
        ]);
    }

    private function getFeedbackMessagesByCategoryId()
    {

    }

    private function getFeedbackCategories(): array
    {
        return [
            ["id" => 1, "name" => "Магазин"],
            ["id" => 2, "name" => "Сайт"],
            ["id" => 3, "name" => "Расписание"],
        ];
    }
}
