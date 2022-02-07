<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$PeriodoID			= $_POST['PeriodoID'];
$AlimentoID 		= $_POST['AlimentoID'];
$MedidaID	 		= $_POST['MedidaID'];
$codigoPai 			= $_REQUEST['codigoPai'];
$UsuarioID			= $_SESSION['Operador_ID'];


//Tratamento

$Quantidade 		= $_POST['Quantidade'];
$Quantidade 		= str_replace(",", ".", $Quantidade);
if(!$Quantidade)
		$Quantidade= 0;

if(!$MedidaID)
		$MedidaID= 0;

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
			$sql = "insert into pessoas_alimentos (PeriodoID, AlimentoID,  PessoaID, UsuarioIncID, Quantidade, MedidaID) 
			values ('$PeriodoID','$AlimentoID','$codigoPai','$UsuarioID','$Quantidade','$MedidaID')";
			$msg = "Cadastro efetuado com sucesso.";
			$urlRedirecionamento = "cadastro.php?msg=$msg&codigoPai=$codigoPai";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update pessoas_alimentos set PeriodoID='$PeriodoID', AlimentoID='$AlimentoID', Quantidade='$Quantidade', MedidaID='$MedidaID' where ID=$ID";
			$urlRedirecionamento = "index.php?codigo= $codigoPai";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from pessoas_alimentos where ID=$ID";
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
