<?php

namespace AppBundle\Repository;


use Doctrine\ORM\QueryBuilder;

class AdvertRepository extends AbstractCustomRepository
{
    public function getFilterQueryBuilder(array $query) : QueryBuilder
    {
        $qb = $this->createQueryBuilder(self::ENTITY_ALIAS);

        if (!empty($query['author'])) {
            $qb->andWhere(self::ENTITY_ALIAS . '.author = :author')
                ->setParameter('author', $query['author']);
        }

        $qb->orderBy(self::ENTITY_ALIAS . '.createdAt', 'DESC');

        return $qb;
    }
}