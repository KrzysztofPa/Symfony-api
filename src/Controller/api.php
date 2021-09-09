<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
     * @Route("/add")
     */
    public function addUser(): Response
    {
        $user = new Users();

        $form = $this->createForm(UserType::class, $user);
        return $this->render('database/new.html.twig',
            ['form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/sendToDatabase", methods={"POST"})
     */
    public function parseUserToDatabase(EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $user->setFirstName('Jan')
            ->setLastName('Pawel')
            ->setAge(rand(1, 100));

        $entityManager->persist($user);
        $entityManager->flush();


        return new Response('get');

    }

    /**
     * @Route("/show")
     */
    public function show(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Users::class);
        $users = $repository->findAll();
        return $this->render('database/show.html.twig', [
            'users' => $users
        ]);

    }

}