<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Cms;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CmsManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPage($key)
    {
        return $this->entityManager->getRepository(Cms::class)->getPage($key);
    }

}
