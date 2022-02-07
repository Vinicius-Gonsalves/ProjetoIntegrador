<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$Nome				= $_POST['Nome'];
$Quantidade 		= $_POST['Quantidade'];
$codigoPai 			= $_REQUEST['codigoPai'];
$UsuarioID			= $_SESSION['Operador_ID'];
$Quantidade 		= str_replace(",", ".", $Quantidade);
if(!$Quantidade)
		$Quantidade= 0;

//Passo 2: Validacoes e tratamentos
$Erro = 0;

/*if (($Marca=="") and ($action<>'excluir')){
	$mensagemErro = "Marca não informada";
	$urlRedirecionamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;	
}*/

if ($Erro==0)
{
	//Passo 2: Montar os mapeamentos
	switch ($action) {
		
			//query de insercao no banco de dados
		case 'inserir':
			$sql = "insert into alimentos_medidas (Nome, Quantidade, AlimentoID, UsuarioIncID) 
			values ('$Nome','$Quantidade','$codigoPai','$UsuarioID')";
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg&codigoPai=$codigoPai";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update alimentos_medidas set Nome='$Nome', Quantidade='$Quantidade' where ID=$ID";
			$urlRedirecionamento = "index.php?codigo= $codigoPai";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from alimentos_medidas where ID=$ID";
			$urlRedirecionamento = "index.php?codigo= $codigoPai";
			break;
	} 

	//Passo 4: Executar função responsavel por executar um query no banco "mysql_query"
	//echo $sql;
	//echo $urlRedirecionamento;
	$executarDB = mysql_query($sql);
}	

//Passo 5: Redirecionamento
header("Location: $urlRedirecionamento");
?>
