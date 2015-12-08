<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use Doctrine\ORM\EntityManager;

trait EntityManagerAwareTrait
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
}
