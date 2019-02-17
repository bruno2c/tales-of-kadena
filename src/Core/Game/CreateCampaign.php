<?php

namespace App\Core\Game;

use App\Entity\Campaign;
use Doctrine\ORM\EntityManager;

class CreateCampaign
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function run()
    {
        $campaign = new Campaign();
        $campaign->setHash(uniqid('CAM', true));

        $this->em->persist($campaign);
        $this->em->flush($campaign);

        $campaign = [
            'id' => $campaign->getHash()
        ];

        return $campaign;
    }
}