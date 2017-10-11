<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractCustomRepository extends EntityRepository
{
    const DEFAULT_LAST_LIMIT = 2;
    const DEFAULT_ENTITIES_PER_PAGE = 6;

    const ENTITY_ALIAS = 'entity';

    protected function findLast($limit = self::DEFAULT_LAST_LIMIT, $sortField = 'id')
    {
        $entities = $this
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->orderBy(self::ENTITY_ALIAS . '.' . $sortField, 'DESC')
            ->getQuery()
            ->setMaxResults($limit)
            ->getResult();

        return $entities;
    }

    public function findFilteredByPage(
        array $filters,
        int $page = 1,
        int $entitiesPerPage = self::DEFAULT_ENTITIES_PER_PAGE
    ): array {
        return $this
            ->findFiltered(
                $filters,
                ($page - 1) * $entitiesPerPage,
                $entitiesPerPage
            );
    }

    public function findFiltered(
        array $query,
        int $offset = 0,
        int $entitiesPerPage = self::DEFAULT_ENTITIES_PER_PAGE
    ): array {
        return $this
            ->getFilterQueryBuilder($query)
            ->setFirstResult($offset)
            ->setMaxResults($entitiesPerPage)
            ->getQuery()
            ->getResult();
    }

    public function getFilteredCount(array $query) : int {
        return $this
            ->getFilterQueryBuilder($query)->select('count(' . self::ENTITY_ALIAS . ')')
            ->getQuery()
            ->getSingleScalarResult();
    }

    abstract protected function getFilterQueryBuilder(array $query) : QueryBuilder;
}