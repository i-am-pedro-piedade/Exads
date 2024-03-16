<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ABTestService;

#[Route('/a-b-testing', methods: ['GET'])]
class ABTestingController extends AbstractController
{
    #[Route('/', name: 'a_b_testing_index')]
    public function index(ABTestService $aBTestService): Response
    {
        return $this->render('abtesting/index.html.twig', ['list' => $aBTestService->getAll()]);
    }

    #[Route('/{id}', name: 'a_b_testing_detail')]
    public function detail(ABTestService $aBTestService, int $id): Response
    {
        return $this->render('abtesting/detail.html.twig', [
            'id' => $id,
            'design' => $aBTestService->getById($id),
        ]);
    }

    #[Route('/{id}/test', name: 'a_b_testing_detail_test')]
    public function testDetail(ABTestService $aBTestService, int $id): Response
    {
        return $this->render('abtesting/test.html.twig', [
            'id' => $id,
            'distributions' => $aBTestService->testDistributionById($id),
        ]);
    }
}
