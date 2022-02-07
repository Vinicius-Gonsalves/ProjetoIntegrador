<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//Passo 1: Receber as variáveis do formulário	
$ID					= $_REQUEST['codigo'];
$action 			= $_REQUEST['action'];

$Peso				= $_POST['Peso'];
$Altura 			= $_POST['Altura'];
$Imc	 			= $_POST['Imc'];
$codigoPai 			= $_REQUEST['codigoPai'];
$UsuarioID			= $_SESSION['Operador_ID'];

$Peso				= str_replace(",", ".", $Peso);
$Altura 			= str_replace(",", ".", $Altura);

if(!$Imc){
	$Imc = $Peso/($Altura*$Altura);

}else{
	$Imc	 		= str_replace(",", ".", $Imc);
}

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
			$sql = "insert into pessoas_avaliacao (Peso, Altura, Imc, PessoaID, UsuarioIncID) 
			values ('$Peso','$Altura','$Imc','$codigoPai','$UsuarioID')";
			$msg = "Cadastro efetuado com sucesso.";
			//$urlRedirecionamento = "cadastro.php?msg=$msg&codigoPai=$codigoPai";
			$urlRedirecionamento = "index.php?codigo= $codigoPai";
			break;
			
			//query de atualização no banco de dados
		case 'alterar':
			$sql = "update pessoas_avaliacao set Peso='$Peso', Altura='$Altura', Imc='$Imc', PessoaID='$codigoPai', UsuarioIncID='$UsuarioID' where ID=$ID";
			$urlRedirecionamento = "index.php?codigo= $codigoPai";
			break;
			
			//query de exclusao no banco de dados
		case 'excluir':
			$sql = "delete from pessoas_avaliacao where ID=$ID";
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
