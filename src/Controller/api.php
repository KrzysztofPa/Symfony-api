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
    public function homepage()
    {

        return $this->render('api/homepage.html.twig');

    }

    /**
     * @Route("/add")
     */
    public function add(EntityManagerInterface $entityManager)
    {
        $user = new Users();
        $user->setFirstName('Jan')
        ->setLastName('Pawel')
        ->setAge(rand(1,100));

        $entityManager->persist($user);
        $entityManager->flush();
        dd($user);
        return new Response('get');

    }

    /**
     * @Route("/show", methods={"POST"})
     */
    public function show()
    {
        return new Response('show');

    }

}