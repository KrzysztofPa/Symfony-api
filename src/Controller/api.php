<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/add")
     */
    public function addUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();

        $form = $this->createForm(UserType::class, $user);

        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            header("Location: /user_add_success");
            die();
        }


        return $this->render('database/new.html.twig',
            ['form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/user_add_success")
     */
    public function userAddSuccess(): Response
    {
        return new Response('success');

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