<?php 
	namespace Produtos\View\Helper;
	
	use Zend\View\Helper\AbstractHelper;

	

	class PaginationHelper extends AbstractHelper{

		private $produtos;
		private $qntPagina;
		private $url;


		public function __invoke($produtos,$qntPagina,$url){
			$this->produtos = $produtos->count();
			$this->qntPagina = $qntPagina;
			$this->url = $url;

			return $this->gerarPagination();
		}

		private function gerarPagination(){
			$totalPage = ceil($this->produtos / $this->qntPagina);
			$html = '<ul class="pagination">';
			$count = 1;
			while ($count <= $totalPage) {
				$html .= '<li class="page-item"><a href="'.$this->url.'/'.$count.'" class="page-link">'.$count.'</a></li>';
				$count++;
			}
			$html .= '</ul>';
			return $html;
		}
	}