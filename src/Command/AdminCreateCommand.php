<?php

namespace App\Command;

use App\Entity\User\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminCreateCommand extends Command
{
    protected static $defaultName        = 'admin:create';
    protected static $defaultDescription = 'Add a short description for your command';

    private $passwordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager   = $entityManager;

        parent::__construct(null);
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email address')
            ->addArgument('password', InputArgument::OPTIONAL, 'Admin password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email    = $input->getArgument('email');
        $password = $input->getArgument('password');

        $newAdmin = new Admin();
        $newAdmin
            ->setEmail($email)
            ->setPassword($this->passwordEncoder->encodePassword($newAdmin, $password))
            ->setRoles(['ROLE_ADMIN'])
        ;

        $this->entityManager->persist($newAdmin);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
