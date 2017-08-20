<?php 
	
	namespace Produtos\Entity;

	use Doctrine\ORM\Mapping as ORM;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
	use Zend\InputFilter\InputFilter;


	/** @ORM\Entity(repositoryClass="Produtos\Entity\Repository\ProdutosRepository")	*/
	class Produtos implements InputFilterAwareInterface	{
		/**
	    *@ORM\Id
	    *@ORM\GeneratedValue(strategy="AUTO")
	    *@ORM\Column(type="integer")
	    */
		private $id;

		/** 
		*@ORM\Column(type="string")
		*/
		private $nome;

		/** 
		*@ORM\Column(type="decimal", scale=2)
		*/
		private $preco;

		/** 
		*@ORM\Column(type="string")
		*/
		private $descricao;
		/**
		*@ORM\ManyToOne(targetEntity="Produtos\Entity\Categoria", inversedBy="produto")
		*@ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable = false)
		*/
		private $categoria;

		/*constroi um novo produto CREATE*/
		public function __construct($nome, $preco, $descricao){
			$this->nome = $nome;
			$this->preco = $preco;
			$this->descricao = $descricao;
		}
		/*fim constroi um novo produto READ*/



		/*pega os  valores*/
		public function getId(){
			return $this->id;
		}

		public function  getName(){
			return $this->nome;
		}
		public function  getPrice(){
			return $this->preco;
		}
		public function  getDescri(){
			return $this->descricao;
		}

		public function getCategoria(){
			return $this->categoria;
		}
		/*fim pega valores*/



		/*seta novos valores UPDATE*/

		public function setName($nome){
			$this->nome = $nome;
		}
		public function setPrice($preco){
			$this->preco = $preco;
		}
		public function setDescri($descricao){
			$this->descricao = $descricao;
		}
		public function setCategoria(Categoria $categoria){
			$this->categoria = $categoria;
		}

		/*fim seta novos valores UPDATE*/




		public function setInputFilter(InputFilterInterface $inputFilter){
			throw new Exception("Error Processing Request");
			
		}
		public function getInputFilter(){
			$inputFilter = new InputFilter();

			$inputFilter->add([
				'name' => 'nome',
				'required' => true,
				'validators' => [
					[
						'name'=> 'StringLength',
						'options' => [
							'min' => 3,
							'max' => 100,
							
						]
					]
				]

			]);

			return $inputFilter;
		}

	}
	
 ?>