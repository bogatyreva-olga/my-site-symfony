<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ColorsController extends AbstractController
{
    private const COLORS = [
        [
            "id" => 1,
            "value" => '#16a085'
        ],

        [
            "id" => 2,
            "value" => '#27ae60'
        ],

        [
            "id" => 3,
            "value" => '#2c3e50'
        ],

        [
            "id" => 4,
            "value" => '#f39c12'
        ],

        [
            "id" => 5,
            "value" => '#e74c3c'
        ],

        [
            "id" => 6,
            "value" => '#9b59b6'
        ],

        [
            "id" => 7,
            "value" => '#FB6964'
        ],

        [
            "id" => 8,
            "value" => '#342224'
        ],

        [
            "id" => 9,
            "value" => '#472E32'
        ],

        [
            "id" => 10,
            "value" => '#BDBB99'
        ],

        [
            "id" => 11,
            "value" => '#77B1A9'
        ],

        [
            "id" => 12,
            "value" => '#73A857'
        ]
    ];

    /**
     * @Route("/random-colors")
     */
    public function getRandomColors(Request $request): JsonResponse
    {
        $colors = self::COLORS;
        $excludeId = (int)$request->query->get('excludeId');
        if ($excludeId > 0) {
            $colors = array_filter($colors, function ($el) use ($excludeId) {
                return $el['id'] !== $excludeId;
            });
        }
        $randomIndex = rand(0, count($colors) - 1);
        dump($randomIndex, $colors);
        return $this->json($colors[$randomIndex]);
    }
}
