<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$Nome 				= $_POST['Nome'];
$SexoID 			= $_POST['SexoID'];
$DataNasc 			= $_POST['DataNasc'];
$Email 				= $_POST['Email'];
$WhatsApp 			= $_POST['WhatsApp'];
$Celular			= $_POST['Celular'];
$IsPaciente			= $_POST['IsPaciente'];
$IsNutricionista	= $_POST['IsNutricionista'];
$Ativo				= $_POST['Ativo'];
$CidadeID			= $_POST['CidadeID'];
$UsuarioID			= $_SESSION['Operador_ID'];


if($IsPaciente)
	$IsPaciente= 1;
else
	$IsPaciente= 0;

if($IsNutricionista)
	$IsNutricionista= 1;
else
	$IsNutricionista= 0;

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
			$sql = "insert into pessoas (Nome,SexoID,DataNasc,Email,WhatsApp,Celular,IsPaciente,IsNutricionista,Ativo,CidadeID, UsuarioIncID) 
			values ('$Nome','$SexoID','$DataNasc','$Email','$WhatsApp','$Celular', '$IsPaciente','$IsNutricionista', '$Ativo',$CidadeID, $UsuarioID)";
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update pessoas set Nome='$Nome', SexoID='$SexoID', DataNasc='$DataNasc', Email='$Email', WhatsApp='$WhatsApp', Celular='$Celular', IsPaciente='$IsPaciente', IsNutricionista='$IsNutricionista', Ativo='$Ativo', CidadeID=$CidadeID, UsuarioUltAltID=$UsuarioID, UsuarioUltAltDataHora=now() where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from pessoas where ID=$ID";
			$urlRedirecionamento = "index.php";
			break;
	} 

	//Passo 4: Executar função responsavel por executar um query no banco "mysql_query"
	//echo $sql;
	$executarDB = mysql_query($sql);
}	

//Passo 5: Redirecionamento
header("Location: $urlRedirecionamento");
?>
