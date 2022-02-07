<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$Marca 				= $_POST['Marca'];
$Modelo 			= $_POST['Modelo'];
$Quilometragem 		= $_POST['Quilometragem'];
$Marchas 			= $_POST['Marchas'];
$Valor 				= $_POST['Valor'];

//Passo 2: Validacoes e tratamentos
$Erro = 0;

if (($Marca=="") and ($action<>'excluir')){
	$mensagemErro = "Marca não informada";
	$urlRedirecionamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;	
}

if ($Erro==0)
{
	//Passo 2: Montar os mapeamentos
	switch ($action) {
		
			//query de insercao no banco de dados
		case 'inserir':
			$sql = "insert into veiculos (Marca,Modelo,Quilometragem,Marchas,Valor) 
			values ('$Marca','$Modelo','$Quilometragem','$Marchas','$Valor')";
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update veiculos set Marca='$Marca', Modelo='$Modelo' ,Quilometragem='$Quilometragem', Marchas=$Marchas, Valor='$Valor' where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from veiculos where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
	} 

	//Passo 4: Executar função responsavel por executar um query no banco "mysql_query"
	$executarDB = mysql_query($sql);
}	

//Passo 5: Redirecionamento
header("Location: $urlRedirecionamento");
?>
