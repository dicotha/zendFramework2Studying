<?php
	namespace Produtos\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Produtos\Entity\Produtos;

	class IndexController extends AbstractActionController {

		public function IndexAction(){

			$pagina = $this->params()->fromRoute('page',1);
			$qntPagina = 2;
			$offset = ($pagina - 1) * $qntPagina;

			$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$repositorio = $entityManager->getRepository('Produtos\Entity\Produtos');

			$produtos = $repositorio->getProdutosPaginados($qntPagina,$offset);

			/*$produtos = $repositorio->findAll();*/

			$view_params = array(
				'produtos' => $produtos,
				'qntPagina' => $qntPagina
			);

			return new ViewModel($view_params);
			
		}

		public function CadastrarAction(){

			if($this->request->isPost()){

				$nome = $this->request->getPost('nome');
				$preco = $this->request->getPost('preco');
				$descricao = $this->request->getPost('descricao');

				$produto = new Produtos($nome,$preco,$descricao);

				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$entityManager->persist($produto);
				$entityManager->flush();
				
				return $this->redirect()->toUrl('index/index');
			}

			return new ViewModel();
		}

		public function RemoverAction(){

			$id = $this->params()->fromRoute('id');

			if($this->request->isPost()){
				$id = $this->request->getPost('id');
				$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$repositorio = $entityManager->getRepository('Produtos\Entity\Produtos');

				$produto = $repositorio->find($id);

				$entityManager->remove($produto);
				$entityManager->flush();
				
				return $this->redirect()->toUrl('index');	
			}
			




			return new ViewModel(['id'=> $id]);
		}


		public function EditarAction(){

			$id = $this->params()->fromRoute('id');

			if(is_null($id)){
				$id = $this->request->getPost('id');	
			}

			$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$repositorio = $entityManager->getRepository('Produtos\Entity\Produtos');
			$produto = $repositorio->find($id);

			if($this->request->isPost()){
				$produto->setName($this->request->getPost('nome'));
				$produto->setPrice($this->request->getPost('preco'));
				$produto->setDescri($this->request->getPost('descricao'));

				$entityManager->persist($produto);
				$entityManager->flush();

				$this->flashMessenger()->addSuccessMessage('Produto Alterado com Sucesso');
				return $this->redirect()->toUrl('index');
			}

			

			return new ViewModel(['produto'=>$produto]);
		}


	}


?>