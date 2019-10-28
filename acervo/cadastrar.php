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
		isset($_POST['tipo'])
	){
		$acervo = new Acervo($_POST['idEditora'], $_POST['titulo'], $_POST['autor'], $_POST['ano'], $_POST['preco'], $_POST['quantidade'], $_POST['tipo']);
		$acervo->save();
	}
	else {
		http_response_code(400);
	}
?>