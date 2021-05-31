<?php

namespace App\Repository\Quiz;

use App\Entity\Quiz\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function getGame(): Game
    {
        $game = $this->findOneBy([]);

        if (null === $game) {
            $game = new Game();
            $this->getEntityManager()->persist($game);
            $this->getEntityManager()->flush();
        }

        return $game;
    }
}
