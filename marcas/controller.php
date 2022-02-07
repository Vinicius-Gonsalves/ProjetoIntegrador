<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$Nome				= trim($_POST['Nome']);

//Passo 2: Validacoes e Tratamentos
$Erro = 0;
						  //<> = diferente
if (($Nome=="") and ($action<>'excluir')){
	$mensagemErro = "Nome não informado";
	$urlRedirecionamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;
}

if ($Erro==0)
{


	//Passo 3: Montar os mapeamentos
	switch ($action) {
		
			//query de insercao no banco de dados
		case 'inserir':
			$sql = "insert into Marca (Nome) 
			values ('$Nome')";
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update Marca set Nome='$Nome' where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from Marca where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
	} 


	//Passo 4: Executar função responsavel por executar um query no banco "mysql_query"
	$executarDB = mysql_query($sql);

}

//Passo 5: Redirecionamento
header("Location: $urlRedirecionamento");
?>
