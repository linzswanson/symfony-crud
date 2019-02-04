<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

//    public static function createNonDeletedCriteria(): Criteria
//    {
//        return Criteria::create()
//            ->andWhere(Criteria::expr()->eq('isDeleted', false))
//            ->orderBy(['createdAt' => 'DESC'])
//            ;
//    }

    /**
     * @param string|null $term
     */
    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');


        //this section will not be used since there is no search input
        if ($term) {
            $qb->andWhere('c.content LIKE :term OR c.authorName LIKE :term OR a.title LIKE :term')
                ->setParameter('term', '%' . $term . '%')
            ;
        }

        return $qb
            ->orderBy('c.id', 'DESC')
            ;
    }
}


