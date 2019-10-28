<?php
	require "../editora/Editora.php";
    class Acervo {
		public $id;
		public $idEditora;
		public $titulo;
		public $autor;
		public $ano;
		public $preco;
		public $quantidade;
		public $tipo;
		public $editora;
		function __construct($idEditora, $titulo, $autor, $ano, $preco, $quantidade, $tipo){
			$this->idEditora = $idEditora;
			$this->titulo = $titulo;
			$this->autor = $autor;
			$this->ano = $ano;
			$this->preco = $preco;
			$this->quantidade = $quantidade;
			$this->tipo = $tipo;
		}
		function save(){
			global $con;
			if(isset($this->id)){
				$stmt = $con->prepare("UPDATE acervo SET idEditora=?, titulo=?, autor=?, ano=?, preco=?, quantidade=?, tipo=? WHERE id=?");
				$stmt->execute(array($this->idEditora, $this->titulo, $this->autor, $this->ano, $this->preco, $this->quantidade, $this->tipo, $this->id));				
			}
			else {
				$stmt = $con->prepare("INSERT INTO acervo (idEditora, titulo, autor, ano, preco, quantidade, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$stmt->execute(array($this->idEditora, $this->titulo, $this->autor, $this->ano, $this->preco, $this->quantidade, $this->tipo));
			}
		}
		function delete(){
			global $con;
			$stmt = $con->prepare("DELETE FROM acervo WHERE id=?");
			$stmt->execute(array($this->id));
		}
		static function get($id){
			global $con;
			$stmt = $con->prepare("SELECT * FROM acervo WHERE id=?");
			$stmt->execute(array($id));
			$result = $stmt->fetch();
			$acervo = new Acervo($result['idEditora'], $result['titulo'], $result['autor'], $result['ano'], $result['preco'], $result['quantidade'], $result['tipo']);
			$acervo->id = $result['id'];
			$acervo->editora = Editora::get($result['idEditora']);
			return $acervo;
		}
		static function getAll($busca = null){
			global $con;
			if(isset($busca)){
				$stmt = $con->prepare("SELECT * FROM acervo WHERE LOWER(titulo) LIKE ?");
				$stmt->execute(array("%$busca%"));
			}
			else {
				$stmt = $con->prepare("SELECT * FROM acervo");
				$stmt->execute();
			}
			$results = $stmt->fetchAll();
			return array_map(function($value){
				$acervo = new Acervo($value['idEditora'], $value['titulo'], $value['autor'], $value['ano'], $value['preco'], $value['quantidade'], $value['tipo']);
				$acervo->id = $value['id'];
				$acervo->editora = Editora::get($value['idEditora']);
				return $acervo;
			}, $results);
		}
	}
?>