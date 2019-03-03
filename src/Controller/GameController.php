<?php

namespace App\Controller;

use App\Core\Battle\BattleResponse;
use App\Core\Game\CreateBattle;
use App\Core\Game\CreateCampaign;
use App\Entity\Campaign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{
    public function newCampaign()
    {
        $em = $this->getDoctrine()->getManager();

        $createCampaign = new CreateCampaign($em);
        $campaign = $createCampaign->run();

        return new JsonResponse($campaign);
    }

    public function newBattle($campaignId)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            if (!$campaignId) {
                throw new \Exception('Invalid request, campaign id is missing');
            }

            $campaign = $em->getRepository(Campaign::class)->findOneBy(['hash' => $campaignId]);

            if (!$campaign) {
                throw new \Exception('Invalid request, campaign not found');
            }

            $battleResponse = new BattleResponse($em);

            $createCampaign = new CreateBattle($em);
            $battle = $createCampaign->run($campaign);

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