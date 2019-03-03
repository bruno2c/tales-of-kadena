<?php

namespace App\Controller;

use App\Core\Battle\BattleAction;
use App\Core\Battle\BattleResponse;
use App\Core\Battle\DecideEnemyAction;
use App\Core\Battle\DecideTurn;
use App\Core\Stage\PrepareStage;
use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\BattleTurn;
use App\Entity\Creature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
                    'slot' => $char->getSlot()
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

    public function attack(Request $request, $battleId)
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

            $enemySlot = $request->request->get('enemySlot');

            $turnChar = null;
            $targetChar = null;

            if ($openTurn->getTurnSide() == BattleTurn::TURN_SIDE_ENEMIES) {
                $turnChar = $em->getRepository(BattleEnemy::class)->find($openTurn->getTurnCharacter());
                $targetChar = $em->getRepository(BattleChampion::class)->findOneBy(['battle' => $battle, 'slot' => $enemySlot]);

                if (!$targetChar) {
                    throw new \Exception('Invalid request, this target does not belongs to the battle');
                }
            }

            if ($openTurn->getTurnSide() == BattleTurn::TURN_SIDE_CHAMPIONS) {
                $turnChar = $em->getRepository(BattleChampion::class)->find($openTurn->getTurnCharacter());
                $targetChar = $em->getRepository(BattleEnemy::class)->findOneBy(['battle' => $battle, 'slot' => $enemySlot]);

                if (!$targetChar) {
                    throw new \Exception('Invalid request, this target does not belongs to the battle');
                }
            }

            $battleAction = new BattleAction();
            $battleAction->setTurnCharacter($turnChar);
            $battleAction->setTargetCharacter($targetChar);
            $battleAction->setAction(BattleAction::ACTION_ATTACK);
            $battleAction->execute();
            $battleAction->register($em, $openTurn);

            $battleResponse = new BattleResponse($em);

            $response = [
                'code' => Response::HTTP_OK,
                'battle' => $battleResponse->prepareResponse($battle)
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }

        return new JsonResponse($response);
    }

    public function enemyAct(Request $request, $battleId)
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

            $decideAction = new DecideEnemyAction($em, $battle);
            $action = $decideAction->roll();
            $decideAction->register($action);

            $battleResponse = new BattleResponse($em);

            $response = [
                'code' => Response::HTTP_OK,
                'battle' => $battleResponse->prepareResponse($battle)
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