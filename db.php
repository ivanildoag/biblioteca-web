<?php
	$con = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");

	$con->exec("
		CREATE TABLE IF NOT EXISTS editora (
			id INTEGER AUTO_INCREMENT PRIMARY KEY,
			nome VARCHAR(60)
		)
	");
	
	$con->exec("
		CREATE TABLE IF NOT EXISTS acervo (
			id INTEGER AUTO_INCREMENT PRIMARY KEY,
			idEditora INTEGER,
			titulo VARCHAR(100),
			autor VARCHAR(60),
			ano INTEGER,
			preco DOUBLE,
			quantidade INTEGER,
			tipo INTEGER,
			FOREIGN KEY (idEditora) REFERENCES editora(id) ON DELETE CASCADE
		)
	");
?>