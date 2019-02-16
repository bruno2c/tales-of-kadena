<?php

namespace App\Controller;

use App\Entity\Monster;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index()
    {
        $enemies = $this->getDoctrine()->getRepository(Monster::class)->findAll();
        shuffle($enemies);
        $enemies = array_slice($enemies, 0, 3);

        return $this->render('index/index.html.twig', [
            'enemies' => $enemies
        ]);
    }
}