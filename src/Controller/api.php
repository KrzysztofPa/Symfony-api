<?php


namespace App\Controller;


use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class api extends AbstractController
{
    /**
     * @Route("/", name="api_homepage")
     */
    public function homepage(): Response
    {

        return $this->render('database/homepage.html.twig');

    }

    /**
     * @Route("/add", methods={"POST"})
     */
    public function add(EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $user->setFirstName('Jan')
            ->setLastName('Pawel')
            ->setAge(rand(1, 100));

        $entityManager->persist($user);
        $entityManager->flush();
        dd($user);
        return new Response('get');

    }

    /**
     * @Route("/show")
     */
    public function show(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Users::class);
        $users = $repository->findAll();
dump($users);
        return $this->render('database/show.html.twig', [
            'users' => $users
        ]);

    }

}