<?php
    class Editora {
		public $id;
		public $nome;
		function __construct($nome){
			$this->nome = $nome;
		}
		function save(){
			global $con;
			if(isset($this->id)){
				$stmt = $con->prepare("UPDATE editora SET nome=? WHERE id=?");
				$stmt->execute(array($this->nome, $this->id));				
			}
			else {
				$stmt = $con->prepare("INSERT INTO editora (nome) VALUES (?)");
				$stmt->execute(array($this->nome));
			}
		}
		function delete(){
			global $con;
			$stmt = $con->prepare("DELETE FROM editora WHERE id=?");
			$stmt->execute(array($this->id));
		}
		static function get($id){
			global $con;
			$stmt = $con->prepare("SELECT * FROM editora WHERE id=?");
			$stmt->execute(array($id));
			$result = $stmt->fetch();
			$editora = new Editora($result['nome']);
			$editora->id = $result['id'];
			return $editora;
		}
		static function getAll($busca = null){
			global $con;
			if(isset($busca)){
				$stmt = $con->prepare("SELECT * FROM editora WHERE LOWER(nome) LIKE ?");
				$stmt->execute(array("%$busca%"));
			}
			else {
				$stmt = $con->prepare("SELECT * FROM editora");
				$stmt->execute();
			}
			$results = $stmt->fetchAll();
			return array_map(function($value){
				$editora = new Editora($value['nome']);
				$editora->id = $value['id'];
				return $editora;
			}, $results);
		}
	}
?>