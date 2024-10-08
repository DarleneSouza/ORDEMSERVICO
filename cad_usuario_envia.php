<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$perfil = 1;
$status = $_POST["status"];
$data=date("y/m/d");
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

require_once ("bd/bd_usuario.php");
$dados = buscaUsuario($email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	header ("Location:cad_usuario.php");
}else{
	$dados = cadastraUsuario($nome,$senha,$email,$perfil,$status,$data,$cep, $logradouro, $bairro, $cidade, $estado);
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
		header ("Location:usuario.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome_usu'] = $nome;
		$_SESSION['email'] = $email;
		header ("Location:cad_usuario.php");
	}
	
}

?>