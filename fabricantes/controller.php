<?php
include_once "../../includes/sessao.php";
include_once "../../includes/conecta.php"; 

//PASSO 1: receber as variaveis do formulario
$ID				= $_REQUEST['codigo'];
$action			= $_REQUEST['action'];

$Nome			= trim($_POST['Nome']);

//PASSO 2: Validacoes e tratamento
$Erro = 0;

if (($Nome=="") and ($action<>'excluir')){
    $mensagemErro = "Nome não informado";
	$urlRedirecinamento = "cadastro.php?mensagemErro=$mensagemErro";
	$Erro = 1;
}

if ($Erro==0)
{

//PASSO 3: montar os mapeamentos
switch ($action) {
    case 'inserir':
	    //inserir
	    $sql = "insert into fabricante (Nome) 
        values ('$Nome')";
		$msg = "Cadastro efetuado com sucesso";
        $urlRedirecinamento = "cadastro.php?msg=$msg";
		
        break;
		//query de atualizacao no banco de dados
    case 'alterar':
        $sql = "update fabricante set Nome='$Nome' where ID=$ID";
        $urlRedirecinamento = "index.php";
		break;
    case 'excluir':
	    //query de exclusao do banbo de dados
        $sql = " delete from fabricante where ID=$ID";
		$urlRedirecinamento = "index.php";
        break;
}


//PASSO 4: funcao responcavel por executa um query no banco "mysql"

$executarDB = mysql_query($sql);

}


//PASSO 5: redirecionamento
header ("Location: $urlRedirecinamento");



?>