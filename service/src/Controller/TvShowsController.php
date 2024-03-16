<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\TvShowFilterType;
use App\Repository\TvShowIntervalRepository;
use App\Repository\TvShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tv-shows', methods: ['GET'])]
class TvShowsController extends AbstractController
{
    #[Route('', name: 'tv_shows_index')]
    public function index(Request $request, TvShowIntervalRepository $tvShowIntervalRepository, TvShowRepository $tvShowsRepository, EntityManagerInterface $entityManager): Response
    {
        $filterForm = $this->createForm(TvShowFilterType::class, null, ['entity_manager' => $entityManager]);
        $filterForm->handleRequest($request);
        $queryData = $filterForm->getData();

        return $this->render(
            'tvshows/index.html.twig',
            [
                'filterForm' => $filterForm->createView(),
                'nextShow' => $tvShowIntervalRepository->findNext($queryData),
                'shows' => $tvShowsRepository->findAllSortedByTitle(),
            ]
        );
    }
}
