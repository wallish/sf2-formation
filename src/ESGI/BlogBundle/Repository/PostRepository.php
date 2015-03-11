<?php
namespace ESGI\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
	public function findPublished()
	{
		 return $this->createQueryBuilder('p')
		 	->andWhere('p.isPublished = :published')
		 	->leftJoin('p.category', 'c')
		 	->orderBy('p.created', 'DESC')
		 	->setParameter('published',true)
		 	->getQuery()
		 	->getResult();
	}
}