<?php


//aqui esta sendo feito a conexão com o banco de dados, atraves do PDO
try{
	$pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", "");
}catch(PDOException $e){
	echo"erro com a conekão com o banco de dados".$e->getMessage();	
}catch(Exception $e){
	echo"erro generico".$e->getMessage();
}
//~~~~~//~~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~//~~~//~~~//
//                       		INSERT                                 //

$comando = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUE(:n, :t, :e)");

$comando->bindValue(":n","Gabriel");
$comando->bindValue(":t","14997858866");
$comando->bindValue(":e","gg405246@gmail.com");


//$nome = "pinga";
//$telefone = 14996697785;
//$email = "pingarebolalentinhoproscria@gmail.com";
//$comando->bindParam(":n", $nome);
//$comando->bindParam(":t", $telefone);
//$comando->bindParam(":e", $email);


//$comando->execute();

//~~~~~//~~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~//~~~//~~~//
//                       DELETE E UPDATE                               //

$comando = $pdo->prepare("DELETE FROM pessoa  WHERE id = :id");
$id = 2;

$comando->bindValue(":id", $id);
//$comando->execute();


//$id = 4;
//$comando = $pdo->query("DELETE FROM pessoa  WHERE id = $id");
//----------------------------UPDATE-----------------------------------//



//$comando = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
//$comando->bindValue(":id", 3);
//$comando->bindValue(":e","pingaficoudexereco@gmail.com");
//$comando->execute();
$email = "pingaficoudexerecooo@gmail.com";
$id = 3;
$comando = $pdo->query("UPDATE pessoa SET email = '$email' WHERE id = '$id'");
//$comando->execute();

//~~~~~//~~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~~//~~~//~~~//~~~//
//----------------------------SELECT-----------------------------------//

$comando = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$comando->bindValue(":id", 3);
$comando->execute();
$resultado = $comando->fetch(PDO::FETCH_OBJ);
foreach ($resultado as $key => $value) {

	echo"".$key." ".$value."<br>";

}
