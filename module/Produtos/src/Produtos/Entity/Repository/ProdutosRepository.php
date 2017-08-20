<?php 

	namespace Produtos\Entity\Repository;

	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Tools\Pagination\Paginator;


	class ProdutosRepository extends EntityRepository{


		public function getProdutosPaginados($qntPagina,$offset){

		 
			$em = $this->getEntityManager();
			$qb = $em->createQueryBuilder();

			$qb->select('p')
			   ->from('Produtos\Entity\Produtos', 'p')
			   ->setMaxResults($qntPagina)
			   ->setFirstResult($offset)
			   ->orderBy('p.id');

			$query = $qb->getQuery();

			$paginator = new Paginator($query);

			return $paginator;

		}
		
	}
	
