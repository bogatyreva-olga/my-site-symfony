<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\FeedbackMessage;
use App\Repository\FeedbackMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback/messages", methods={"GET"})
     */
    public function getMessagesWithCategory(Request $request, FeedbackMessageRepository $repository): JsonResponse
    {
        $categoryId = (int)$request->query->get("categoryId");
        /*здесь будет код, к-ый будет отфильтровывать массив сообщений по категории, вернуть*/

        return $this->json(["feedbackMessages" => $repository->getFeedbackMessagesByCategoryId($categoryId)]);
    }

    /**
     * @Route("/feedback/messages", methods={"POST"})
     */
    public function saveMessages(Request $request, FeedbackMessageRepository $repository): JsonResponse
    {
        $userName = $request->request->get('userName');
        $message = $request->request->get('message');
        $categoryId = (int)$request->request->get('categoryId');
        $fbm = new FeedbackMessage($userName, $message, $categoryId);
        $messages = $repository->getMessages();
        $messages[] = $fbm;
        $repository->persistMessages($messages);

        return $this->json($fbm);
    }

    /**
     * @Route("/feedback-message")
     */
    public function index(FeedbackMessageRepository $repository): Response
    {
        return $this->render('feedback-message/feedback-message.html.twig', [
            'feedbackMessages' => $repository->getFeedbackMessagesByCategoryId(),
            'categories' => $this->getFeedbackCategories(),
        ]);
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
