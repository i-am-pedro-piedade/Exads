<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Ascii;

#[Route('/ascii', methods: ['GET'])]
class AsciiListController extends AbstractController
{
    #[Route('', name: 'ascii_index')]
    public function index(Ascii $asciiService): Response
    {
        return $this->render(
            'ascii/index.html.twig',
            ['ascii' => $asciiService->generate()]
        );
    }
}
