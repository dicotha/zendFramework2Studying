<?php 
	
	namespace Produtos\Entity;

	use Doctrine\ORM\Mapping as ORM;


	/** @ORM\Entity(repositoryClass="Produtos\Entity\Repository\ProdutosRepository")	*/
	class Produtos
	{
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

		/*fim seta novos valores UPDATE*/


	}
	
 ?>