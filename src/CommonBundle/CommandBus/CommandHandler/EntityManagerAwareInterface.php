<?php

namespace RP\CommonBundle\CommandBus\CommandHandler;

use Doctrine\ORM\EntityManager;

interface EntityManagerAwareInterface
{
    /**
     * @param EntityManager $em
     */
    public function setEntityManager(EntityManager $em);
}
