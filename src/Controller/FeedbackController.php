<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback-message", name="feedback-message")
     */
    public function feedbackMessagesRender(): Response
    {
        return $this->render('feedback-message/feedback-message.html.twig');
    }
}
