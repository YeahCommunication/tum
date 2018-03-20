<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

final class CmsRepository extends EntityRepository
{
    /**
     * Return the value for the key or $default.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $entity = $this->findOneBy(array('key' => $key));

        return $entity ? $entity->getValue() : $default;
    }

    public function getPage($alias)
    {
        $entity = $this->findOneBy(array('alias' => $alias));

        $items = $entity->getItems();

        $tmp = array();
        foreach($items as $item){
            $tmp[$item->getAlias()] = $item->getContent();
        }

        return array_merge($entity->getValue(), $tmp);
    }

    /**
     * Return all the values for key like "root%".
     *
     * @param string $root
     *
     * @return array
     */
    public function getAll($root)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where($qb->expr()->like('c.key', ':key'))
            ->setParameter('key', $root.'%');

        $values = array();
        foreach ($qb->getQuery()->getArrayResult() as $result) {
            $values[$result['key']] = $result['value'];
        }

        return $values;
    }
}
