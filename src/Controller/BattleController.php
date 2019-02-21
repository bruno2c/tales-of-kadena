<?php

namespace App\Controller;

use App\Core\Battle\BattleAction;
use App\Core\Battle\DecideTurn;
use App\Core\Stage\PrepareStage;
use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\BattleTurn;
use App\Entity\Creature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BattleController extends AbstractController
{
    public function nextTurn($battleId)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            if (!$battleId) {
                throw new \Exception('Invalid request, battle id is missing');
            }

            $battle = $em->getRepository(Battle::class)->findOneBy(['hash' => $battleId]);

            if (!$battle) {
                throw new \Exception('Invalid request, campaign not found');
            }

            /** @var BattleTurn $openTurn */
            $openTurn = $em->getRepository(BattleTurn::class)->getOpenTurn($battle);

            if ($openTurn) {
                $turnChar = $openTurn->getTurnCharacter();

                return new JsonResponse([
                    'code' => Response::HTTP_OK,
                    'turn' => [
                        'side' => $openTurn->getTurnSide(),
                        'characterId' => $turnChar
                    ]
                ]);
            }

            $battleChampions = $em->getRepository(BattleChampion::class)->findBy(['battle' => $battle]);
            $battleEnemies = $em->getRepository(BattleEnemy::class)->findBy(['battle' => $battle]);

            $decideTurn = new DecideTurn($battle);

            foreach ($battleChampions as $battleChampion) {
                $decideTurn->addCharacter($battleChampion);
            }

            foreach ($battleEnemies as $battleEnemy) {
                $decideTurn->addCharacter($battleEnemy);
            }

            $char = $decideTurn->roll();
            $decideTurn->register($em);

            $response = [
                'code' => Response::HTTP_OK,
                'turn' => [
                    'side' => $decideTurn->getCurrentTurnSide(),
                    'characterId' => $char->getId()
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }

        return new JsonResponse($response);
    }

    public function attack($battleId, $targetCharId)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            if (!$battleId) {
                throw new \Exception('Invalid request, battle id is missing');
            }

            $battle = $em->getRepository(Battle::class)->findOneBy(['hash' => $battleId]);

            if (!$battle) {
                throw new \Exception('Invalid request, campaign not found');
            }

            /** @var BattleTurn $openTurn */
            $openTurn = $em->getRepository(BattleTurn::class)->getOpenTurn($battle);

            if (!$openTurn) {
                throw new \Exception('Invalid request, no one open turn found');
            }

            $turnChar = null;
            $targetChar = null;

            if ($openTurn->getTurnSide() == BattleTurn::TURN_SIDE_ENEMIES) {
                $turnChar = $em->getRepository(BattleEnemy::class)->find($openTurn->getTurnCharacter());
                $targetChar = $em->getRepository(BattleChampion::class)->findOneBy(['battle' => $battle, 'id' => $targetCharId]);

                if (!$targetChar) {
                    throw new \Exception('Invalid request, this target does not belongs to the battle');
                }
            }

            if ($openTurn->getTurnSide() == BattleTurn::TURN_SIDE_CHAMPIONS) {
                $turnChar = $em->getRepository(BattleChampion::class)->find($openTurn->getTurnCharacter());
                $targetChar = $em->getRepository(BattleEnemy::class)->findOneBy(['battle' => $battle, 'id' => $targetCharId]);

                if (!$targetChar) {
                    throw new \Exception('Invalid request, this target does not belongs to the battle');
                }
            }

            $battleAction = new BattleAction();
            $battleAction->setTurnCharacter($turnChar);
            $battleAction->setTargetCharacter($targetChar);
            $battleAction->attack();
            $battleAction->register($em, $openTurn);

            $response = [
                'code' => Response::HTTP_OK,
                'report' => $battleAction->getReport()
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }

        return new JsonResponse($response);
    }
}