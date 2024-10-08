<?php
session_start();
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$telefone = $_POST["telefone"];
$status = $_POST["status"];
$perfil = 2;
$data=date("y/m/d");

require_once ("bd/bd_cliente.php");
$dados = buscaCliente($email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	$_SESSION['cep'] = $cep;
	$_SESSION['logradouro'] = $logradouro;
	$_SESSION['bairro'] = $bairro;
	$_SESSION['cidade'] = $cidade;
	$_SESSION['estado'] = $estado;
	$_SESSION['telefone'] = $telefone;
	header ("Location:cad_cliente.php");
}else{

	$dados = cadastraCliente($nome,$email,$senha,$cep, $logradouro, $bairro, $cidade, $estado,$telefone,$status,$perfil,$data);

	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		unset($_SESSION['cep']);
        unset($_SESSION['logradouro']);
        unset($_SESSION['bairro']);
        unset($_SESSION['cidade']);
        unset($_SESSION['estado']);
		unset ($_SESSION['telefone']);
		header ("Location:cliente.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['cep'] = $cep;
        $_SESSION['logradouro'] = $logradouro;
        $_SESSION['bairro'] = $bairro;
        $_SESSION['cidade'] = $cidade;
        $_SESSION['estado'] = $estado;
		$_SESSION['telefone'] = $telefone;
		header ("Location:cad_cliente.php");
	}
}

?>