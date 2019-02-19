<?php

namespace App\Controller;

use App\Core\Stage\PrepareStage;
use App\Entity\Creature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class StageController extends AbstractController
{
    public function enemies($stageId)
    {
//        $monsterRepository = $this->getDoctrine()->getRepository(Monster::class);
//
//        $prepareStage = new PrepareStage($monsterReposi?tory);
////        $enemies = $prepareStage->getRandomEnemies();
//
//        return new JsonResponse($enemies);
    }
}