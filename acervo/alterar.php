<?php
	require "../db.php";
	require "Acervo.php";
	if(
		isset($_POST['idEditora']) &&
		isset($_POST['titulo']) &&
		isset($_POST['autor']) &&
		isset($_POST['ano']) &&
		isset($_POST['preco']) &&
		isset($_POST['quantidade']) &&
		isset($_POST['tipo']) &&
		isset($_GET['id'])
	){
		$acervo = Acervo::get($_GET['id']);
		$acervo->idEditora = $_POST['idEditora'];
		$acervo->titulo = $_POST['titulo'];
		$acervo->autor = $_POST['autor'];
		$acervo->ano = $_POST['ano'];
		$acervo->preco = $_POST['preco'];
		$acervo->quantidade = $_POST['quantidade'];
		$acervo->tipo = $_POST['tipo'];
		$acervo->save();
	}
	else {
		http_response_code(400);
	}
?>