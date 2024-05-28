<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Entity\Program;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            ]);
    }

    #[Route('/{programId}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(int $programId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        // same as $program = $programRepository->find($id);
        $seasons = $seasonRepository->findBy(['program' => $program], ['number' => 'ASC']);
        
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons]);
    }

    #[Route('/{programId}/season/{seasonId}', name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['program' => $program, 'id' => $seasonId]);
        $episodes = $episodeRepository->findBy(['season' => $season], ['number' => 'ASC']);

        return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season, 'episodes' => $episodes]);
    }
}
