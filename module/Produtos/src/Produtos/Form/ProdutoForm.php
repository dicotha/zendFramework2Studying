<?php 
	namespace Produtos\Form;

	use Zend\Form\Form;
	use Zend\Form\Element;
	use Doctrine\ORM\EntityManager;
	class ProdutoForm extends Form{
		
		public function __construct(EntityManager $entityManager){

			parent::__construct('formProduto');


			/*campo nome do formulario*/
			$this->add([
				'type' => 'text',
				'name' => 'nome',
				'attributes' => [
					'class' => 'form-control'
				]
			]);
			/*fim*/
			/*campo preco do formulario*/
			$this->add([
				'type' => 'number',
				'name' => 'preco',
				'attributes' => [
					'class' => 'form-control'
				]
			]);
			/*fim*/
			/*campo preco do formulario*/
			$this->add([
				'type' => 'Textarea',
				'name' => 'descricao',
				'attributes' => [
					'class' => 'form-control'
				]
			]);
			/*fim*/
			/*campo categoria do formulario*/
			$this->add([
				'type' => 'DoctrineModule\Form\Element\ObjectSelect',
				'name' => 'categoria',
				'options' => [
					'object_manager' => $entityManager,
					'target_class' => 'Produtos\Entity\Categoria',
					'property' => 'nome',
					'empty_option' => 'Escolha uma categoria'
				],
				'attributes' => [
					'class' => 'form-control'
				]
			]);
			/*fim*/
			/*token*/
			$this->add(new Element\Csrf('csrf'));
			/*fim*/

		}
	}

 ?>