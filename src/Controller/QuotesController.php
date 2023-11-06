<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotesController extends AbstractController
{

    private const QUOTES = [
        [
            "id"=> 1,
            "text"=> "Скалолазание - моя свобода. Моя жизнь в вертикальном мире ",
            "author"=> "Линн Хилл"
        ],
        [
            "id"=> 2,
            "text"=> "Мозг- самая важная мышца в скалолазании",
            "author"=> "Вольфганг Гюллих"
        ],
        [
            "id"=> 3,
            "text"=> "Я никогда не тренируюсь на самом деле. Я просто всегда был скалолазом",
            "author"=> "Крис Шарма"
        ],
        [
            "id"=> 4,
            "text"=> "Никогда я не исследовал жизнь так интенсивно в ее красоте, как когда я свободно висел на кончиках двух пальцев над глубокой впадиной",
            "author"=> "Вольфганг Гюллих"
        ],
        [
            "id"=> 5,
            "text"=> "Есть два типа альпинистов: те, кто поднимается, потому что их сердце поет, когда они в горах, и все остальные",
            "author"=> "Алекс Лоу"
        ],
        [
            "id"=> 6,
            "text"=> "Горы - это не стадионы, на которых я удовлетворяю свои амбиции, это соборы, где я исповедую свою религию",
            "author"=> "Анатолий Букреев"
        ],
    ];

    /**
     * @Route("/quotes", name="quotes")
     */
    public function quotes(): Response
    {
        return $this->render('quotes/quotes.html.twig');
    }
    /**
     * @Route("/random-quotes")
     */
    public function getRandomQuotes(): JsonResponse
    {
        return $this->json(self::QUOTES[0]);
    }
}
