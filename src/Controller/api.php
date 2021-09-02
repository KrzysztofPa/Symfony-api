<?php


namespace App\Controller;


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
     * @Route("/add", name="api_add",  methods={"POST"})
     */
    public function getApi()
    {
        return new Response('get');

    }

}