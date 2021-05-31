<?php

namespace App\Controller;

use App\Entity\Quiz\Game;
use App\Entity\Quiz\Vote;
use App\Entity\User\Guest;
use App\Repository\Quiz\GameRepository;
use App\Repository\User\GuestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="app_quiz")
     */
    public function index(GameRepository $gameRepository): Response
    {
        /** @var Guest $user */
        $user = $this->getUser();

        if (null === $user) {
            return $this->render('quiz/welcome.html.twig');
        }

        $game = $gameRepository->getGame();

        switch ($game->getStage()) {
            case Game::STAGE_WAITING:
                return $this->render('quiz/waiting.html.twig');
            case Game::STAGE_CAPTAIN:
                $team = $user->getTeam();
                return $this->render('quiz/captain.html.twig', ['members' => $team ? $team->getMembers() : []]);
        }

        return $this->render('quiz/index.html.twig');
    }

    /**
     * @Route(path="/quiz/start", name="app_quiz_start")
     *
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function start(GameRepository $gameRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $game = $gameRepository->getGame();
            $game
                ->setStage(Game::STAGE_CAPTAIN);

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('app_quiz');
    }

    /**
     * @Route(path="/quiz/vote", name="app_quiz_vote")
     *
     * @param Request $request
     * @param GuestRepository $guestRepository
     * @return JsonResponse
     */
    public function vote(Request $request, GuestRepository $guestRepository): JsonResponse
    {
        /** @var Guest $user */
        $user = $this->getUser();
        $team = $user->getTeam();
        $captain = $guestRepository->find($request->get('vote'));

        $vote = new Vote();
        $vote
            ->setTeam($team)
            ->setCaptain($captain);

        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();

        return $this->json(['success' => true]);
    }
}
