<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Divisors;

#[Route('/divisors', methods: ['GET'])]
class DivisorsController extends AbstractController
{
    #[Route('', name: 'divisors_index')]
    public function index(Divisors $divisors): Response
    {
        return $this->render(
            'divisors/index.html.twig',
            ['numbers' => $divisors->generateNumbersAndDivisors()]
        );
    }
}
