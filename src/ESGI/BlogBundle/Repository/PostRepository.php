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

	public function count($published)
	{
		if(isset($published)){
			$count = $this->createQueryBuilder('p')
					 	->select('count(p.id)')
					 	->andWhere('p.isPublished = :published')
					 	->setParameter('published',$published)
					 	->getQuery()
					 	->getSingleScalarResult();
		 }else{
		 	$count = $this->createQueryBuilder('p')
						 	->select('count(p.id)')
						 	->getQuery()
						 	->getSingleScalarResult();
		 }

		 return $count;
	}

	public function paginator()
	{
		$em = $this->getEntityManager();
        $dql   = "SELECT a FROM ESGIBlogBundle:Post a";
        $query = $em->createQuery($dql);

      

       return $query;
	}
}